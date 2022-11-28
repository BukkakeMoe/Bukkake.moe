<?php require_once("includes/header.php");?>
<script>
document.title = "Bukkake MOE - Videos";
</script>
<div class="container">
	<div class="videoSection">
	<?php require_once("includes/classes/pagination.php");
if(isset($_GET["orderBy"])){
    $orderBy = '&orderBy='.$_GET["orderBy"];
}else{
    $orderBy = '&orderBy=decending';
}
    ?>
<!--<ul class="pagination">
        <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>-->
            <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                <a class="page-link" href="?pageno=1<?php echo $orderBy ?>" tabindex="-1">First</a>
            </li>
            <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1).$orderBy; } ?>" tabindex="-1">Previous</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1).$orderBy ;}?>">Next</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a>
            </li>
        </ul>
            </nav>
	</div>
</div>

<?php
require_once("includes/footer.php");
?>