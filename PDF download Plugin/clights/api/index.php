<?php
require '../vendor/slim/slim/Slim/Slim.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->add(new \Slim\Middleware\SessionCookie(array('secret' => 'myappsecret')));

$app->contentType('application/json');
$app->expires('-1000000');
$db = new PDO('sqlite:db.sqlite3');

define ('ADMIN_USER_ID', 1);

function returnResult($action, $success = true, $id = 0, $req = array())
{
    echo json_encode(array(
        'action' => $action,
        'success' => $success,
        'id' => intval($id),
        'req' => $req,
        'session' => json_encode($_SESSION)
    ));
}

function filterNull($var)
{
    return ($var != null || $var == '0' || $var == 'false');
}

function isLoggedIn($db, $app, $userId)
{
    return currentUser($db, $app) == $userId;
}

function currentSession($db, $app)
{
    $sth = $db->prepare('SELECT * FROM user_sessions WHERE sessionID = ? LIMIT 1;');
    $sth->execute(array(
        0 => $app->getCookie('PHPSESSID')
    ));
    $res = $sth->fetch();
    return $res;
}

function currentProject($db, $app)
{
    $res = currentSession($db, $app);
    return $res['projectId'];
}

function currentUser($db, $app)
{
    $res = currentSession($db, $app);
    return $res['userId'];
}


function customersForDealer($db, $app)
{
    $dealer = currentUser($db, $app);
    $sth = $db->prepare('SELECT id FROM customers WHERE dealer = ?;');
    $sth->execute(array(
        0 => intval($dealer)
    ));
    $ids = array();
    $res = $sth->fetchAll();
    foreach($res as $value)
    {
        $ids[] = intval($value['id']);
    }
    return $ids;
}

function projectsForCustomer($db, $app, $cmId)
{
    $sth = $db->prepare('SELECT id FROM projects WHERE customer = ?;');
    $sth->execute(array(
        0 => intval($cmId)
    ));
    $ids = array();
    $res = $sth->fetchAll();
    foreach($res as $value)
    {
        $ids[] = intval($value['id']);
    }
    return $ids;
}

/* ACCOUNT ROUTES */
// LOGIN
$app->post('/login', function() use ($db, $app) {
    $username = $app->request()->post('username');
    $password = $app->request()->post('password');
    $sth = $db->prepare('SELECT password, id FROM dealers WHERE username = ? LIMIT 1;');
    $sth->execute(array(
        0 => $username
    ));
    $res = $sth->fetch();
    $id = intval($res['id']);
    $success = $password == $res['password'];
    $sth = $db->prepare('DELETE FROM user_sessions WHERE sessionID = ?;');
    $result = $sth->execute(array(
        0 => $app->getCookie('PHPSESSID')
    ));
    if ($success) {
        $sth = $db->prepare('INSERT INTO user_sessions (sessionID, datevisited, userId) VALUES (?, ?, ?);');
        $sth->execute(array(
            0 => $app->getCookie('PHPSESSID'),
            1 => time(),
            2 => $id
        ));
    }
    returnResult('login', $success, $id, array(
        "usertype" => $id == ADMIN_USER_ID ? 'admin' : 'dealer',
        "isLoggedIn" => isLoggedIn($db, $app, $id)
    ));
});
// LOGOUT
$app->get('/logout', function() use ($db, $app) {
    $dealer = currentUser($db, $app);
    $sth = $db->prepare('DELETE FROM user_sessions WHERE sessionID = ?;');
    $result = $sth->execute(array(
        0 => $app->getCookie('PHPSESSID')
    ));
    returnResult('logout', $result, $dealer, array(
        "isLoggedIn" => !$result
    ));
});


/* PROJECT ROUTES */
// CREATE
$app->post('/project', function () use ($db, $app) {
    $customer = $app->request()->post('customer');
    $image = $app->request()->post('image');
    $amount = $app->request()->post('amount');
    $sth = $db->prepare('INSERT INTO projects (customer, image, amount) VALUES (?, ?, ?);');
    $sth->execute(array(
        0 => intval($customer),
        1 => empty($image) ? "" : $image,
        2 => intval($amount)
    ));
    $id = $db->lastInsertId();
    returnResult('add', $sth->rowCount() == 1, $id, $app->request()->post());
});

// READ
// Routes for GET request for an item or all items
$app->get('/project', function () use ($db, $app) {
    $sth = $db->query('SELECT * FROM projects;');
    echo json_encode($sth->fetchAll(PDO::FETCH_CLASS));
});
// - project for current session
$app->get('/project/current', function () use ($db, $app) {
    $projectId = currentProject($db, $app);
    echo json_encode(array('id' => intval($projectId)));
});
// - single record
$app->get('/project/:id', function ($id) use ($db, $app) {
    $customers = customersForDealer($db, $app);
    $sth = $db->prepare('SELECT * FROM projects WHERE id = ? LIMIT 1;');
    $sth->execute(array(
        0 => intval($id)
    ));
    $res = $sth->fetchAll(PDO::FETCH_CLASS);
    $project = (array)reset($res);
    $isDealerCmProject = in_array(intval($project['customer']), array_values($customers));
    if ($isDealerCmProject) {
        echo json_encode($project);
    } else {
        echo json_encode(false);
    }
});
// - all layers for project by id
$app->get('/project/layer/:pid', function ($pid) use ($db, $app) {
    $sth = $db->prepare('SELECT * FROM layers WHERE project = ?;');
    $sth->execute(array(
        0 => intval($pid)
    ));
    echo json_encode($sth->fetchAll(PDO::FETCH_CLASS));
});
// - single layer by id for project by id
$app->get('/project/layer/:pid/:lid', function ($pid, $lid) use ($db, $app) {
    $sth = $db->prepare('SELECT * FROM layers WHERE project = ? AND id = ? LIMIT 1;');
    $sth->execute(array(
        0 => intval($pid),
        1 => intval($lid)
    ));
    $res = $sth->fetchAll(PDO::FETCH_CLASS);
    echo json_encode(reset($res));
});

// - find project by customer id
$app->get('/project/customer/:id', function ($id) use ($db, $app) {
    $customers = customersForDealer($db, $app);
    $isDealerCmProject = in_array(intval($id), array_values($customers));
    if ($isDealerCmProject) {
        $sth = $db->prepare('SELECT * FROM projects WHERE customer = ? LIMIT 1;');
        $sth->execute(array(
            0 => intval($id)
        ));
        $res = $sth->fetchAll(PDO::FETCH_CLASS);
        echo json_encode(reset($res));
    } else {
        echo json_encode(false);
    }
});
// UPDATE
$app->put('/project/:id', function ($id) use ($db, $app) {
    $image = $app->request()->put('image');
    $amount = $app->request()->put('amount');
    $sth = $db->prepare('UPDATE projects SET image = ?, amount = ? WHERE id = ?;');
    $sth->execute(array(
        0 => empty($image) ? "" : $image,
        1 => empty($amount) ? '0' : $amount,
        2 => intval($id)
    ));
    returnResult('add', $sth->rowCount() == 1, $id);
});
// DELETE
$app->delete('/project/:id', function ($id) use ($db) {
    $sth = $db->prepare('DELETE FROM projects WHERE id = ?;');
    $sth->execute(array(
        0 => intval($id)
    ));
    returnResult('delete', $sth->rowCount() == 1, $id);
});

/* CUSTOMER ROUTES */
// CREATE
$app->post('/customer', function () use ($db, $app) {
    $dealer = $app->request()->post('dealer');
    $customer_id = $app->request()->post('customer_id');
    $name = $app->request()->post('name');
    $address_1 = $app->request()->post('address_1');
    $address_2 = $app->request()->post('address_2');
    $city = $app->request()->post('city');
    $state = $app->request()->post('state');
    $zip = $app->request()->post('zip');
    $phone = $app->request()->post('phone');
    $bid_date = $app->request()->post('bid_date');
    $sth = $db->prepare('INSERT INTO customers (dealer, `customer_id`, name, `address_1`, `address_2`, city, state, zip, phone, bid_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
    $sth->execute(array(
        0 => intval($dealer),
        1 => $customer_id,
        2 => $name,
        3 => $address_1,
        4 => empty($address_2) ? "" : $address_2,
        5 => $city,
        6 => $state,
        7 => empty($zip) ? "" : $zip,
        8 => $phone,
        9 => empty($bid_date) ? round(microtime(true) * 1000) : intval($bid_date) || round(microtime(true) * 1000)
    ));
    $id = $db->lastInsertId();
    returnResult('add', $sth->rowCount() == 1, $id, $app->request()->post());
});
// READ
// - main
$app->get('/customer', function () use ($db, $app) {
    $dealer = currentUser($db, $app);
    $sth = $db->prepare('SELECT * FROM customers WHERE dealer = ?;');
    $sth->execute(array(
        0 => intval($dealer)
    ));
    echo json_encode($sth->fetchAll(PDO::FETCH_CLASS));
});
// - single record
$app->get('/customer/:id', function ($id) use ($db, $app) {
    $sth = $db->prepare('SELECT * FROM customers WHERE id = ? LIMIT 1;');
    $sth->execute(array(
        0 => intval($id)
    ));
    $res = $sth->fetchAll(PDO::FETCH_CLASS);
    echo json_encode(reset($res));
});
// UPDATE
$app->put('/customer/:id', function ($id) use ($db, $app) {
    $name = $app->request()->put('name');
    $address_1 = $app->request()->put('address_1');
    $address_2 = $app->request()->put('address_2');
    $city = $app->request()->put('city');
    $state = $app->request()->put('state');
    $zip = $app->request()->put('zip');
    $phone = $app->request()->put('phone');
    $bid_date = $app->request()->put('bid_date');
    $fields = array();
    $fields[] = !empty($name) ? "name='$name'" : null;
    $fields[] = !empty($address_1) ? "address_1='$address_1'": null;
    $fields[] = !empty($address_2) ? "address_2='$address_2'": null;
    $fields[] = !empty($city) ? "city='$city'" : null;
    $fields[] = !empty($state) ? "state='$state'" : null;
    $fields[] = !empty($zip) ? "zip='$zip'" : null;
    $fields[] = !empty($phone) ? "phone='$phone'" : null;
    $fields[] = !empty($bid_date) ? "bid_date='$bid_date'" : null;
    $f = implode(', ', array_filter($fields, "filterNull"));
    $query = "UPDATE customers SET $f WHERE id=$id;";
    $sth = $db->prepare($query);
    $sth->execute();
    returnResult('update', $sth->rowCount() == 1, $id);
});
// DELETE
$app->delete('/customer/:id', function ($id) use ($db) {
    $sth = $db->prepare('DELETE FROM customers WHERE id = ?;');
    $sth->execute(array(
        0 => intval($id)
    ));

    returnResult('delete', $sth->rowCount() == 1, $id);
});


/* DEALER ROUTES */
// CREATE
$app->post('/dealer', function () use ($db, $app) {
    $username = $app->request()->post('username');
    $password = $app->request()->post('password');
    $name = $app->request()->post('name');
    $address_1 = $app->request()->post('address_1');
    $address_2 = $app->request()->post('address_2');
    $city = $app->request()->post('city');
    $state = $app->request()->post('state');
    $zip = $app->request()->post('zip');
    $phone = $app->request()->post('phone');
    $sth = $db->prepare('INSERT INTO dealers (username, password, name, `address_1`, `address_2`, city, state, zip, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);');
    $sth->execute(array(
        0 => $username,
        1 => $password,
        2 => $name,
        3 => empty($address_1) ? "" : $address_1,
        4 => empty($address_2) ? "" : $address_2,
        5 => $city,
        6 => $state,
        7 => empty($zip) ? "" : $zip,
        8 => empty($phone) ? "" : $phone,
    ));
    $id = $db->lastInsertId();
    returnResult('add', $sth->rowCount() == 1, $id, $app->request()->post());
});
// GET
// - main
$app->get('/dealer', function () use ($db, $app) {
    $sth = $db->query('SELECT * FROM dealers;');
    echo json_encode($sth->fetchAll(PDO::FETCH_CLASS));
});
// - for current session
$app->get('/dealer/current', function () use ($db, $app) {
    $dealer = currentUser($db, $app);
    echo json_encode(array(
        'id' => intval($dealer),
        'admin' => intval($dealer) == ADMIN_USER_ID
    ));
});
// - single record
$app->get('/dealer/:id', function ($id) use ($db, $app) {
    $sth = $db->prepare('SELECT * FROM dealers WHERE id = ? LIMIT 1;');
    $sth->execute(array(
        0 => intval($id)
    ));
    $res = $sth->fetchAll(PDO::FETCH_CLASS);
    echo json_encode(reset($res));
});
// UPDATE
$app->put('/dealer/:id', function ($id) use ($db, $app) {
    $username = $app->request()->post('username');
    $password = $app->request()->post('password');
    $name = $app->request()->post('name');
    $address_1 = $app->request()->post('address_1');
    $address_2 = $app->request()->post('address_2');
    $city = $app->request()->post('city');
    $state = $app->request()->post('state');
    $zip = $app->request()->post('zip');
    $phone = $app->request()->post('phone');
    $fields = array();
    $fields[] = !empty($username) ? "username='$username'" : null;
    $fields[] = !empty($password) ? "password='$password'" : null;
    $fields[] = !empty($name) ? "name='$name'" : null;
    $fields[] = !empty($address_1) ? "address_1='$address_1'": null;
    $fields[] = !empty($address_2) ? "address_2='$address_2'": null;
    $fields[] = !empty($city) ? "city='$city'" : null;
    $fields[] = !empty($state) ? "state='$state'" : null;
    $fields[] = !empty($zip) ? "zip='$zip'" : null;
    $fields[] = !empty($phone) ? "phone='$phone'" : null;
    $f = implode(', ', array_filter($fields, "filterNull"));
    $query = "UPDATE dealers SET $f WHERE id=$id;";
    $sth = $db->prepare($query);
    $sth->execute();
    returnResult('update', $sth->rowCount() == 1, $id);
});
// DELETE
$app->delete('/dealer/:id', function ($id) use ($db) {
    $sth = $db->prepare('DELETE FROM dealers WHERE id = ?;');
    $sth->execute(array(
        0 => intval($id)
    ));
    returnResult('delete', $sth->rowCount() == 1, $id);
});

/* LAYER ROUTES */
// CREATE
$app->post('/layer', function () use ($db, $app) {
    $project = $app->request()->post('project');
    $name = $app->request()->post('name');
    $description = $app->request()->post('description');
    $items = $app->request()->post('items');
    $color = $app->request()->post('color');
    $price = $app->request()->post('price');
    $scale = $app->request()->post('scale');
    $active = $app->request()->post('active');
    $sth = $db->prepare('INSERT INTO layers (project, name, description, items, color, price, scale, active) VALUES (?, ?, ?, ?, ?, ?, ?, ?);');
    $sth->execute(array(
        0 => $project,
        1 => empty($name) ? "" : $name,
        2 => empty($description) ? "" : $description,
        3 => empty($items) ? "" : $items,
        4 => empty($color) ? "white" : $color,
        5 => empty($price) ? 0 : floatval($price),
        6 => empty($scale) ? 10 : intval($scale),
        7 => empty($active) ? 1 : intval($active)
    ));
    $id = $db->lastInsertId();
    returnResult('add', $sth->rowCount() == 1, $id, $app->request()->post());
});
// READ
$app->get('/layer', function () use ($db, $app) {
    $sth = $db->query('SELECT * FROM layers;');
    echo json_encode($sth->fetchAll(PDO::FETCH_CLASS));
});
$app->get('/layer/:id', function ($id) use ($db, $app) {
    $sth = $db->prepare('SELECT * FROM layers WHERE id = ? LIMIT 1;');
    $sth->execute(array(
        0 => intval($id)
    ));
    $res = $sth->fetchAll(PDO::FETCH_CLASS);
    echo json_encode(reset($res));
});
// UPDATE
$app->put('/layer/:id', function ($id) use ($db, $app) {
    $name = $app->request()->put('name');
    $description = $app->request()->put('description');
    $items = $app->request()->put('items');
    $color = $app->request()->put('color');
    $price = $app->request()->put('price');
    $scale = $app->request()->put('scale');
    $active = $app->request()->put('active');
    $fields = array();
    $fields[] = !empty($name) ? "name='$name'" : null;
    $fields[] = !empty($description) ? "description='$description'": null;
    $fields[] = !empty($items) ? "items='$items'" : null;
    $fields[] = !empty($color) ? "color='$color'" : null;
    $fields[] = !empty($price) ? "price='$price'" : null;
    $fields[] = !empty($scale) ? "scale='$scale'" : null;
    $fields[] = filterNull($active) ? "active=$active" : null;
    $f = implode(', ', array_filter($fields, "filterNull"));
    $query = "UPDATE layers SET $f WHERE id=$id;";
    $sth = $db->prepare($query);
    $sth->execute();
    returnResult('update', $sth->rowCount() == 1, $id);
});
// DELETE
$app->delete('/layer/:id', function ($id) use ($db) {
    $sth = $db->prepare('DELETE FROM layers WHERE id = ?;');
    $sth->execute(array(
        0 => intval($id)
    ));

    returnResult('delete', $sth->rowCount() == 1, $id);
});

$app->get('/item', function () use ($db, $app) {
    $sth = $db->query('SELECT * FROM items;');
    echo json_encode($sth->fetchAll(PDO::FETCH_CLASS));
});

$app->get('/item/:id', function ($id) use ($db, $app) {
    $sth = $db->prepare('SELECT * FROM items WHERE id = ? LIMIT 1;');
    $sth->execute(array(
        0 => intval($id)
    ));
    $res = $sth->fetchAll(PDO::FETCH_CLASS);
    echo json_encode(reset($res));
});


$app->run();
