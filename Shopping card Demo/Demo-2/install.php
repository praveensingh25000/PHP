<?php
/*****************************************************************************
 *                                                                           *
 * Shop-Script FREE                                                          *
 * Copyright (c) 2005 WebAsyst LLC. All rights reserved.                     *
 *                                                                           *
 ****************************************************************************/

	//installation routine
	
	ini_set("display_errors", "1");

	session_start();

	if (isset($_POST["install"]))
	{
		if (!is_writable("./cfg/connect.inc.php"))
		{
			$error = "Couldn't rewrite file cfg/connect.inc.php.";
		}
		else
		{
			$f = @fopen("./cfg/connect.inc.php","w");
			$s = "<?php
	//database connection settings

	define('DB_HOST', '".$_POST["db_host"]."'); // database host
	define('DB_USER', '".$_POST["db_user"]."'); // username
	define('DB_PASS', '".$_POST["db_pass"]."'); // password
	define('DB_NAME', '".$_POST["db_name"]."'); // database name
	define('ADMIN_LOGIN', '".base64_encode($_POST["admin_login"])."'); //administrator's login
	define('ADMIN_PASS', '".md5($_POST["admin_pass"])."'); //administrator's login

	//database tables
	include(\"./cfg/tables.inc.php\");

?>";
?><?php

			fputs($f,$s);
			fclose($f);

		}

		//try to connect to the database using new settings and register administrator
		include("./cfg/connect.inc.php");

		//choose database file to include
		include("./includes/database/mysql.php");

		$sel = NULL;
		$conn = db_connect(DB_HOST,DB_USER,DB_PASS);
		if ($conn)
		{
			if (!(db_select_db(DB_NAME))) //database connect failed
			{
				$error =  "Couldn't select database ".DB_NAME."<br>Please make sure this database exists";
			}

		}
		else
			$error = "Couldn't connect to the database<br>Please contact your hosting provider to verify database connection settings";


		if (!isset($error)) //successful!
		{
			//create tables
			include("./includes/database/install/mysql.php");

			$_SESSION["log"] = $_POST["admin_login"];
			$_SESSION["pass"] = $_POST["admin_pass"];

			if (isset($_POST["fill_db"])) //fill DB with demo content
			{
				//fill products and categories tables
				$helper = "[#%int!g%#]"; //helper
				if (file_exists("./cfg/demo_database.sql"))
				{
					$f = implode("",file("./cfg/demo_database.sql"));
					$f = explode("INSERT INTO",$f);

					for ($i=1; $i<count($f); $i++)
					{
						db_query(trim("INSERT INTO ".str_replace($helper,"INSERT INTO",$f[$i]))) or die (db_error());
					}
				}

			}

		}
	}

	if (!is_writable("./cfg/connect.inc.php"))
	{
		$error = "File cfg/connect.inc.php is not writable";
	}

?><HTML>

<head>

<link rel=STYLESHEET href="images/install/installer.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Shop-Script FREE installation routine</title>

<script>

	function validate()
	{
		if (document.form1.db_name.value.length<1)
		{
			alert("Please input database name");
			return false;
		}
		if (document.form1.admin_login.value.length<1)
		{
			alert("Please input administrator`s login");
			return false;
		}
		if (document.form1.admin_pass.value.length<1)
		{
			alert("Please input administrator`s password");
			return false;
		}

		return true;
	}


</script>

</head>

<BODY bgColor=white leftMargin=0 topMargin=0 marginwidth="0" marginheight="0">
<TABLE height="100%" cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR>
    <TD>
      <TABLE height=68 cellSpacing=0 cellPadding=0 width="100%" 
      border=0>
        <TBODY>
        <TR>
          <TD vAlign=top align=middle>
            <TABLE height=68 cellSpacing=0 cellPadding=0 width=730 border=0>
              <TBODY>
              <TR>
                <TD>&nbsp;</TD>
                <TD vAlign=top align=left><A 
                  href="http://www.shop-script.com/"><IMG 
                  alt="Ecommerce PHP shopping cart software Shop-Script" 
                  src="images/install/ss_logo.gif" 
                  border=0> </A></TD>
                <TD>&nbsp;</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR>
<TR>
				<TD background="images/install/banner-shadow2.gif" height=4></TD>
			</TR>
  <TR>
    <TD vAlign=top height=22>
      <TABLE height=22 cellSpacing=0 cellPadding=0 width="100%" 
      background="images/install/nav-bar.gif" 
        border=0><TBODY>
        <TR>
          <TD class=header2 vAlign=center align=middle><A 
            href="http://www.shop-script.com/">www.shop-script.com</A> 
          </TD></TR></TBODY></TABLE></TD></TR>
  <TR>
    <TD vAlign=top height="100%">
      <TABLE height="100%" cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD class=home-content vAlign=top align=middle 
          background="images/install/banner-shadow.gif">&nbsp; 
          </TD>
          <TD vAlign=top align=middle width=1 
          background="images/install/arr.gif"><IMG 
            height=8 src="images/install/arr.gif" 
            width=1> </TD>
          <TD vAlign=top align=middle width=730>
            <TABLE height="100%" cellSpacing=0 cellPadding=0 width=730 
              border=0><TBODY>
              <TR>
                <TD vAlign=top align=left bgColor=#faffeb><IMG height=4 
                  src="images/install/banner-shadow.gif" 
                  width=15 border=0></TD>
                <TD vAlign=top align=left width="100%" bgColor=#faffeb><IMG 
                  height=4 
                  src="images/install/banner-shadow.gif" 
                  width="100%" border=0></TD>
                <TD vAlign=top><IMG height=4 
                  src="images/install/banner-shadow.gif" 
                  width=10 border=0></TD>
                <TD vAlign=top align=right width=216><IMG height=4 
                  src="images/install/banner-shadow.gif" 
                  width="100%" border=0></TD>
                <TD vAlign=top align=right width=15><IMG height=4 
                  src="images/install/banner-shadow.gif" 
                  width=15 border=0></TD></TR>
              <TR>
                <TD vAlign=top align=left width=15 bgColor=#faffeb>&nbsp; </TD>
                <TD style="PADDING-RIGHT: 5px" vAlign=top align=left 
                bgColor=#faffeb colSpan=4>

<h1><u>Shop-Script FREE 2.0 installation routine</u></h1>
<p>
<form name=form1 action="install.php" method=post onSubmit="return validate(this);">

<?php
	if (isset($_POST["install"]) && !isset($error))
	{
		echo "<h1>Installation successful!</h1>";
		echo "<p><a href=\"index.php\">Proceed to my shopping cart ...</a>";
	}
	else
	{
?>


                        <TABLE cellSpacing=0 cellPadding=4 width="75%" border=0>
                          <TBODY>
                            <TR> 
                              <TD width="1%"><IMG height=118 
                        src="images/install/package-free.gif" 
                        width=134 align=left border=0> </TD>
                              <TD vAlign=top width="99%"> <P class=blockhead><B>Thank 
                                  you for choosing Shop-Script FREE! </B></P>
                                  <P>Shop-Script FREE - turnkey PHP shopping cart 
                                    software that allows to create and manage 
                                    search engine friendly online store in several 
                                    minutes. For FREE!</P></TD>
                            </TR>
                          </TBODY>
                        </TABLE>
                        <p>
                        <table border="0" cellpadding="0" cellspacing="1" bgcolor="#99CC33">
                          <tr> 
                            <td><table width="100%" border="0" cellpadding="8" cellspacing="1" bgcolor="#FFFFFF">
                                <tr> 
                                  <td><span class="blockhead">Please view/download <a href="http://www.shop-script.com/documentation/shop-script-free.pdf" target="_blank">Shop-Script FREE User Guide (PDF)</a> on how to install Shop-Script FREE.<br>User Guide contains information on how to install and use Shop-Script FREE shopping cart software.</span></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table>


<?php
	if (isset($error)) echo "<p><b><font color=red>$error</font></b>";
?>

<p>
<b>Please specify MySQL database connection settings</b><br>
These settings can be obtained from your hosting provider

<p><table cellpadding=5 border=0>
	<tr>
	 <td align=right>Host:</td>
	 <td><input type=text name=db_host<?php echo isset($_POST["db_host"]) ? " value=\"".$_POST["db_host"]."\"":" value=\"localhost\"";?>></td>
	</tr>

	<tr>
	 <td align=right>Username:</td>
	 <td><input type=text name=db_user<?php echo isset($_POST["db_user"]) ? " value=\"".$_POST["db_user"]."\"":"";?>></td>
	</tr>

	<tr>
	 <td align=right>Password:</td>
	 <td><input type=text name=db_pass<?php echo isset($_POST["db_pass"]) ? " value=\"".$_POST["db_pass"]."\"":"";?>></td>
	</tr>

	<tr>
	 <td align=right>Database name:</td>
	 <td><input type=text name=db_name<?php echo isset($_POST["db_name"]) ? " value=\"".$_POST["db_name"]."\"":"";?>></td>
	</tr>



</table>

<p>
<b>Administrator login and password</b><br>
You will be able to change these login and password later

<p><table cellpadding=5>
	<tr>
	 <td align=right>Login:</td>
	 <td><input type=text name=admin_login value="<?php echo isset($admin_login) ? $admin_login:"admin";?>"></td>
	</tr>
	<tr>
	 <td align=right>Password:</td>
	 <td><input type=text name=admin_pass value="<?php echo isset($admin_pass) ? $admin_pass:"";?>"></td>
	</tr>
</table>


<p>
<input type=checkbox name=fill_db checked> Fill database with demo content (recommended)

<?php
	if (is_writable("./cfg/connect.inc.php"))
	{
		echo "<p><input type=submit name=install value=\"Install\">";
	}
?>

<?php
	}
?>

</form>


                  <P>&nbsp;</P>



			</TD></TR></TBODY></TABLE></TD>
          <TD vAlign=top align=middle width=1 
          background="images/install/arr.gif"><IMG 
            height=3 src="images/install/arr.gif" 
            width=1 border=0> </TD>
          <TD class=home-content vAlign=top align=middle 
          background="images/install/banner-shadow.gif">&nbsp; 
          </TD></TR></TBODY></TABLE></TD></TR>
  <TR vAlign=bottom>
    <TD vAlign=bottom align=middle>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD 
            background="images/install/separator.gif"><IMG 
            height=1 src="images/install/separator.gif" 
            width=1></TD></TR>
        <TR>
          <TD align=middle>
            <TABLE cellSpacing=0 cellPadding=0 width=730 border=0>
              <TBODY>
              <TR>
                <TD class=textmenu vAlign=center align=left width=15>&nbsp; 
</TD>
                <TD class=textmenu vAlign=center align=middle><NOBR>Copyright 
                  © 2005 WebAsyst LLC</NOBR> </TD>
                <TD class=copyright vAlign=center align=right width=15>&nbsp; 
                </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></BODY></HTML>