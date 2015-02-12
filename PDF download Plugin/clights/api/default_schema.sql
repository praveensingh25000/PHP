CREATE TABLE dealers
(
  id          INTEGER PRIMARY KEY AUTOINCREMENT,
  username    TEXT NOT NULL,
  password    TEXT NOT NULL,
  name        TEXT NOT NULL,
  address_1   TEXT,
  address_2   TEXT,
  city        TEXT NOT NULL,
  state       TEXT NOT NULL,
  zip         TEXT,
  phone       TEXT
);

CREATE TABLE projects
(
  id INTEGER PRIMARY KEY,
  customer INTEGER NOT NULL,
  image TEXT NOT NULL,
  amount TEXT NOT NULL
);


DROP TABLE customers;
CREATE TABLE customers
(
  id          INTEGER PRIMARY KEY AUTOINCREMENT,
  dealer      INTEGER NOT NULL,
  customer_id TEXT    NOT NULL,
  name        TEXT    NOT NULL,
  address_1   TEXT    NOT NULL,
  address_2   TEXT,
  city        TEXT    NOT NULL,
  state       TEXT,
  zip         TEXT,
  phone       TEXT    NOT NULL,
  bid_date    INTEGER
);

CREATE TABLE layers
(
  id          INTEGER PRIMARY KEY AUTOINCREMENT,
  project     INTEGER NOT NULL,
  name        TEXT,
  description TEXT,
  items       TEXT,
  color       TEXT,
  price       FLOAT,
  scale       INTEGER,
  active      INTEGER
);

CREATE TABLE items
(
  id          INTEGER PRIMARY KEY AUTOINCREMENT,
  type        INTEGER NOT NULL,
  name        TEXT    NOT NULL,
  description TEXT    NOT NULL,
  data        TEXT,
  meta        TEXT
);

CREATE TABLE user_sessions
(
  id          INTEGER PRIMARY KEY AUTOINCREMENT,
  sessionID   TEXT    NOT NULL,
  datevisited INTEGER NOT NULL,
  userId      INTEGER NOT NULL,
  projectId   INTEGER
);
