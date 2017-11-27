<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);


define('DATABASE', 'sr922');
define('USERNAME', 'sr922');
define('PASSWORD', 'EasV4ALf');
define('CONNECTION', 'sql.njit.edu');

require_once("Classes/Autoloader.php");

// $all_accounts = Collections\accounts::findAll();
// print_r($all_accounts);

$all_accounts = Collections\accounts::findAll();
$one_account = Collections\accounts::findOne(1);
$all_todos = Collections\todos::findAll();
$one_todo = Collections\todos::findOne(1);
?>
<table border="0">
    <tr><th>Select all Account records</th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            Collections\accounts::printHeaders($all_accounts[0]);
        ?>
    </tr>

<?php 
    Collections\accounts::printAll($all_accounts);
       
?>
<table border="0">
    <tr><th>Select One Account record </th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            Collections\accounts::printHeaders($one_account);
        ?>
    </tr>

<?php 
    Collections\accounts::printOne($one_account); 
?>
<table border="0">
    <tr><th>Select all Todos records</th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            Collections\todos::printHeaders($all_todos[0]);
        ?>
    </tr>

<?php 
    Collections\todos::printAll($all_todos);
?>
<table border="0">
    <tr><th>Select one todo record</th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            Collections\todos::printHeaders($one_todo);
        ?>
    </tr>

<?php 
    Collections\todos::printOne($one_todo);

$new_account = new Models\accounts();
$new_account->id = '';
$new_account->email = 'test1@gmail.com';
$new_account->fname = 'Test';
$new_account->lname = 'User1';
$new_account->phone = '87612367890';
$new_account->birthday= '1993-03-06';
$new_account->gender = 'female';
$new_account->password = '1234';
$new_account->save();
$all_accounts = Collections\accounts::findAll();
?>
<table border="0">
    <tr><th>New Insterted record is at the bottom</th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            Collections\accounts::printHeaders($all_accounts[0]);
        ?>
    </tr>

<?php 
    Collections\accounts::printAll($all_accounts);

$record = new Models\todos();
$record->id = '';
$record->owneremail = $new_account->email;
$record->ownerid = $new_account->id;
$record->createddate = '2017-11-13';
$record->duedate = '2017-11-16';
$record->message = 'Updating todos';
$record->isdone = 0;
$record->save();
$all_todos = Collections\todos::findAll();
?>
<table border="0">
    <tr><th>Newly Insterted record is at the bottom</th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            Collections\todos::printHeaders($all_todos[0]);
        ?>
    </tr>

<?php 
    Collections\todos::printAll($all_todos);

$to_update = Collections\accounts::findOne(9);
if($to_update != null)
{    
?>
<table border="0">
    <tr><th>Before Accounts Update </th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            Collections\accounts::printHeaders($to_update);
        ?>
    </tr>

<?php 
    Collections\accounts::printOne($to_update);

$updated = new Models\accounts;
$updated->id = $to_update['id'];
$updated->email = 'newUpdatedEmail@gmail.com';
$updated->fname = $to_update['fname'];
$updated->lname = $to_update['lname'];
$updated->phone = $to_update['phone'];
$updated->birthday= $to_update['birthday'];
$updated->gender = $to_update['gender'];
$updated->password = $to_update['password'];

$updated->save();

?>
<table border="0">
    <tr><th>After Accounts Update </th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            Collections\accounts::printHeaders($new_account);
        ?>
    </tr>

<?php 
    Collections\accounts::printOne($updated);
}
else 
    echo "<h3>No record found to update the account, for the ID passed.</h3>";

$to_update=Collections\todos::findOne(4);
if($to_update != null){
?>
<table border="0">
    <tr><th>Before Todos Update </th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            Collections\todos::printHeaders($to_update);
        ?>
    </tr>

<?php 
    Collections\todos::printOne($to_update);

$updated = new Models\todos();
$updated->id = $to_update['id'];
$updated->owneremail = $to_update['owneremail'];
$updated->ownerid = $to_update['ownerid'];
$updated->createddate = $to_update['createddate'];
$updated->duedate = $to_update['duedate'];
$updated->message = $to_update['message'];
$updated->isdone=1;
$updated->save();

?>
<table border="0">
    <tr><th>After Todos Update </th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            Collections\todos::printHeaders($record);
        ?>
    </tr>

<?php 
    Collections\todos::printOne($updated);
}
else 
    echo "<h3>No record found to update the todo, for the ID passed.</h3>";

$new_account = Collections\accounts::findOne(31);
if($new_account != null){
    $new_account->delete();
    $all_accounts = Collections\accounts::findAll();
    ?>
    <table border="0">
        <tr><th>Before deleting in Accounts</th></tr>
        <tr COLSPAN=2 BGCOLOR="#55ff00">
            <?php
                Collections\accounts::printHeaders($all_accounts[0]);
            ?>
        </tr>

    <?php 
        Collections\accounts::printAll($all_accounts);

    $all_accounts = Collections\accounts::findAll();
    ?>
    <table border="0">
        <tr><th>After deleting in Accounts</th></tr>
        <tr COLSPAN=2 BGCOLOR="#55ff00">
            <?php
                Collections\accounts::printHeaders($all_accounts[0]);
            ?>
        </tr>

    <?php 
        Collections\accounts::printAll($all_accounts);
}
else
    echo "<h1>No record found or already the account has been deleted</h1>";

$record = Collections\todos::findOne(10);
if($record != null){
    $record->delete();
    $all_todos = Collections\todos::findAll();
    ?>
    <table border="0">
        <tr><th>Before deleting in Todos</th></tr>
        <tr COLSPAN=2 BGCOLOR="#55ff00">
            <?php
                Collections\todos::printHeaders($all_todos[0]);
            ?>
        </tr>

    <?php 
        Collections\todos::printAll($all_todos);
        $all_todos = Collections\todos::findAll();
    ?>
    <table border="0">
        <tr><th>After deleting in Todos</th></tr>
        <tr COLSPAN=2 BGCOLOR="#55ff00">
            <?php
                Collections\todos::printHeaders($all_todos[0]);
            ?>
        </tr>

    <?php 
        Collections\todos::printAll($all_todos);
}

else
    echo "<h1>No record found or already the todo has been deleted</h1>";




?>