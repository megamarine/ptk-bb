<!DOCTYPE html>
<html>
<head>
    <!-- Load file CSS Bootstrap dan Select2 melalui CDN -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="assets/stylesheet/bootstrap.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function () {
            $(".select2").select2({
            });
        });
    </script>
    
</head>
<body>
<div class="container">
    <br>
    <h4>Multiple Select (Combo Box) di PHP</h4>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <select name="test[]" class="form-control select2" multiple="multiple">
        <?php 
        $testing = '';
        $numlist = range(1, 5);
        foreach($numlist as $nl)
        {
          if ($nl == $t)
          {
            echo "<option selected value=\"{$nl}\">{$nl}</option>";
          }else
          {
            echo "<option value=\"{$nl}\">{$nl}</option>";
          }
        }
        ?>
    </select>
    <input type="submit" name="save" value="Send" />
    </form>

    <?php
        if(isset($_POST["save"]))
        {
            // $testing=isset($_POST['test'])?$_POST['test']  : '';
            // foreach ($testing as $t){echo $t;}
            
            $t = array();
            $t = implode(',', $_POST['test']);
            echo "implode : ".$t."<br>";
            $tt = array();
            $tt= explode(",", $t);
            echo "explode : ";
            foreach($tt as $tts)
            {
                echo $tts;
            }
        }
    ?>
</div>
</body>
</html>