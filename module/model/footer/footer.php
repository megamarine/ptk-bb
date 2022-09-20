<?php 
$query = getQuery("select version from version order by seq desc limit 1");
while ($row = $query->fetch(PDO::FETCH_ASSOC))
{
    $version = $row["version"];
}
?>
<br><br><br>
<footer id="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <p class="nm" style="font-weight: bold;">&copy; Copyright 2022. PT. Baramuda Bahari. <small><?=$version;?></small></p>
            </div>
        </div>
    </div>
</footer>