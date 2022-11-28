
<?php require_once("includes/header.php"); ?>

<head>
    
    <style>
.navbar a{
    font-family: "Roboto", sans-serif !important;
    color:#a6a6a6;
}
    </style>
</head>
<nav class="navbar navbar-dark" style="background-color: #222327;">

    <ul class="nav nav-fill">
        <?php
        $query = $con->prepare("SELECT * FROM categories ORDER BY name");
		$query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
			$id = $row["id"];
			$name = $row["name"];

			$selected = ($id == $value) ? "selected='selected'" : "";
			
			$html .= "<li class='nav-item'>
            <a class='nav-link' href='?pageno=1&cat=$id'>$name</a>
            </li>
            ";		
        
        }



		echo $html;

        ?>
</nav>

  <!--<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="nav-link" href="?pageno=1&cat=1">Amateur</a>
    <a class="nav-link" href="?pageno=1&cat=2">Anal</a>
    <a class="nav-link" href="?pageno=1&cat=3">Asian</a>
    <a class="nav-link" href="?pageno=1&cat=4">BBW</a>
    <a class="nav-link" href="?pageno=1&cat=5">Big Ass</a>
    <a class="nav-link" href="?pageno=1&cat=6">Big Dick</a>
    <a class="nav-link" href="?pageno=1&cat=7">Big Tits</a>
    <a class="nav-link" href="?pageno=1&cat=8">Blowjob</a>
    <a class="nav-link" href="?pageno=1&cat=9">Bondage</a>
    <a class="nav-link" href="?pageno=1&cat=10">Compilation</a>
    <a class="nav-link" href="?pageno=1&cat=11">DP</a>
    <a class="nav-link" href="?pageno=1&cat=12">Ebony</a>
    <a class="nav-link" href="?pageno=1&cat=13">Gay</a>
    <a class="nav-link" href="?pageno=1&cat=14">Hentai</a>
    <a class="nav-link" href="?pageno=1&cat=15">Lesbian</a>
    <a class="nav-link" href="?pageno=1&cat=16">Interracial</a>
    <a class="nav-link" href="?pageno=1&cat=17">MILF</a>
    <a class="nav-link" href="?pageno=1&cat=18">Shemale</a>
    <a class="nav-link" href="?pageno=1&cat=19">Teen (18+)</a>
    <a class="nav-link" href="?pageno=1&cat=20">Small Tits</a>
    <a class="nav-link" href="?pageno=1&cat=21">Cock Hero</a>
  </div>-->
<div class="container">
	<div class="videoSection">
<?php
ob_start();
require_once("includes/header.php");
require_once("includes/classes/CategoryVideoProvider.php");
if(isset($_GET["orderBy"])){
    $orderBy = '&orderBy='.$_GET["orderBy"];
}else{
    $orderBy = '&orderBy=decending';
}

$buffer=ob_get_contents();
ob_end_clean();

$title = "Bukkake MOE - $catName Videos";
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

echo $buffer;
?>
<script>
var newTitle = "<?php echo $title?>";
if (document.title != newTitle) {
    document.title = newTitle;
}
</script>
<!--<ul class="pagination">
        <li><a href="?pageno=1&cat=<?php echo $cat; ?>">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>&cat=<?php echo $cat.$orderBy; ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>&cat=<?php echo $cat.$orderBy; ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>&cat=<?php echo $cat; ?>">Last</a></li>
    </ul>-->

</div>
<nav aria-label="Page navigation ">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                <a class="page-link" href="?pageno=1&cat=<?php echo $cat; ?>" tabindex="-1">First</a>
            </li>
            <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>&cat=<?php echo $cat.$orderBy; ?>" tabindex="-1">Previous</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1)."&cat=". $cat.$orderBy;} ?>">Next</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="?pageno=<?php echo $total_pages; ?>&cat=<?php echo $cat; ?>">Last</a>
            </li>
        </ul>
            </nav>
</div>
<?php
require_once("includes/footer.php");
?>