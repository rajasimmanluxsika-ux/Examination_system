<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
$conn = new mysqli("localhost", "root", "", "exam_system");

$result = $conn->query("SHOW TABLES");
?>
<h1>Welcome Admin! Full Database View</h1>
<a href="logout.php">Logout</a>
<hr>

<?php
while($row = $result->fetch_array()){
    $table = $row[0];
    echo "<h3 style='color:blue'>Table: $table</h3>";
    
    $data = $conn->query("SELECT * FROM `$table`");
    if($data->num_rows > 0){
        echo "<table border=1 cellpadding=5><tr>";
        // header
        $fields = $data->fetch_fields();
        foreach($fields as $f){ echo "<th>{$f->name}</th>"; }
        echo "<th>Action</th></tr>";

        // data
        while($r = $data->fetch_assoc()){
            echo "<tr>";
            $id_val = reset($r); // first column as ID
            $id_key = $fields[0]->name;
            
            foreach($r as $val){ echo "<td>$val</td>"; }
            echo "<td>
                <a href='edit.php?table=$table&col=$id_key&id=$id_val'>Edit</a> | 
                <a href='delete.php?table=$table&col=$id_key&id=$id_val' onclick='return confirm(\"Delete?\")'>Delete</a>
            </td>";
            echo "</tr>";
        }
        echo "</table><br>";
    }
}
?>