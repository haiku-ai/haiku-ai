<html>

<?php
  $prompt = $_POST['haiku_prompt'];
  $python = "/usr/bin/python3.7";
  $script = "/var/www/html/haiku-ai/haiku-ai.py";
  $command = $python . ' ' . $script . ' ' . $prompt . ' ' . "2>&1";
  exec($command, $output);
  $image = $output[5];
  var_dump($output);
?>
    <style>
        h3 {
            text-align: center;
        }
        .row {
             display: flex;
        }

        .column {

            flex: 50%;
            text-align: center;
            border: 3px solid;
            border-color: red #32a1ce;
        }

        .haiku {
            padding: 170px 0 0;
        }
    </style>

<row>
    <header><h3><?php echo $prompt; ?></h3></header>
    <div class="row">
     <div class="column haiku">
        <p><?php echo $output[2]; ?></p>
        <p><?php echo $output[3]; ?></p>
        <p><?php echo $output[4]; ?></p>
    </div>
    <div class="column">
        <img src="<?php echo $image;?>" alt="No Result" width="500" height="500" />
    </div>
   </div>
</row>
</html>
