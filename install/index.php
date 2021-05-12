<!doctype html>
<html lang="en">
    <head>
       <?php
        if(isset($_POST['verification']))
        {
            $url = 'http://admin.mwtlakshan.com/yt-tool-station/request.php?verification=verification&vcode='.$_POST['vcode'].'&uname='.$_POST['uname'].'&domain='.$_POST['domain'].'&email='.$_POST['email'].'&ip='.$_SERVER['SERVER_ADDR'].':'.$_SERVER['SERVER_PORT'];
            $userAgent = "Purchase code verification on mywebsite.com";
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 20,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer dI8fPrG9X8Y9yITNJqQgGye5MeT0BbOh",
                    "User-Agent: {$userAgent}"
                )
            ));
            
            // Send the request with warnings supressed
            $response = @curl_exec($ch);
            $response = 0;
            if($response == 1)
            {
                $message = '<div class="notification error closeable"><p>Opps! there is wrong purchase key or username. Please verify your details again.</p><a class="close"></a></div>';
            }
            else
            {
                $write_data = 
                        "define('uername','".$_POST['uname']."'); 
                        define('purchasecode','".$_POST['vcode']."'); 
                        define('domain','".$_POST['domain']."'); 
                        define('ip','".$_SERVER['SERVER_ADDR'].':'.$_SERVER['SERVER_PORT']."');";

                $filecontent=file_get_contents('../inc/request.php');
                $pos=strpos($filecontent, '?>');
                $filecontent=substr($filecontent, 0, $pos)."\r\n".$write_data."\r\n".substr($filecontent, $pos);
                file_put_contents('../inc/request.php', $filecontent);

                $config_path = '../admin/inc/config.php';

                $utf8 = "'utf8'";

                $write_data = "<?php
                                    define('DB_HOST','" . $_POST['host'] . "');
                                    define('DB_USER','" . $_POST['username'] . "');
                                    define('DB_PASS','" . $_POST['password'] . "');
                                    define('DB_NAME','" . $_POST['database'] . "');";
                $write_data2 = 'try
                                {
                                    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ' . $utf8 . '"));
                                }
                                catch (PDOException $e)
                                {
                                    exit("Error: " . $e->getMessage());
                                } ?>';

                $host = $_POST['host'];
                $username = $_POST['username'];
                $password = $_POST['password'];             

                try 
                {
                    $conn = new PDO("mysql:host=".$host.";", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $fp = fopen($config_path, 'w');
                    fwrite($fp, $write_data . $write_data2);
                    fclose($fp);
                    //when display form
                    include($config_path);

                    global $dbh;

                    $sql1 = "SELECT IF(EXISTS (SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $_POST['database'] . "'), 'Yes','No')";
                    $query1 = $dbh->prepare($sql1);
                    $status1 = $query1->execute();
                    if (!$status1) 
                    {
                        $sql = "CREATE DATABASE IF NOT EXISTS '" . $_POST['database'] . "' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci; USE '" . $_POST['database'] . "';";
                        $query = $dbh->prepare($sql);
                        $status = $query->execute();
                    }
                    
                    $sql = "SELECT IF(EXISTS (SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $_POST['database'] . "'), 'Yes','No')";
                    $query = $dbh->prepare($sql);
                    $status = $query->execute();
                    if ($status) 
                    {
                        $sql2 = file_get_contents('db.sql');
                        
                        $query2 = $dbh->prepare($sql2);
                        $status2 = $query2->execute();

                        if ($status2) 
                        {
                            $message = '<div class="notification success closeable"><p>Verification, Database configuration & installation completed successfully. <b style="color:red;">Please delete install folder first to use continue.</b><p>Click here to go home <a href="../index.php">Home</a></p></p><a class="close"></a></div>';
                        }
                        else
                        {    
                            $message = '<div class="notification error closeable"><p>Verification, Database configuration & installation having some problem. Please retry database configuration </p> </div>';
                        }
                    }
                    
                }
                catch(PDOException $e)
                {
                    $message = "<div class='notification error closeable'><p>Could not connect to the server '" . $host . "' Please cross verify details.</p></div>\n";
                }
            }
        }
    ?>
        <!-- Basic Page Needs ================================================== -->
        <title>YT Station</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        
    
        <!-- CSS
    ================================================== -->
        <link rel="stylesheet" href="../assets/frontend/css/style.css?<?php echo time() ?>">

            <link rel="stylesheet" href="../assets/frontend/css/colors/blue.css">

    </head>
    <body>
    
        <!-- Wrapper -->
<div id="wrapper">
<div class="msg">
    <?php if(isset($message)){
        echo $message;
    } ?>
</div>
<div class="col-xl-12 purchase" style="max-width: 40%;display: block;position: relative;margin: 0 auto;">
	<div class="dashboard-box margin-top-0">

		<!-- Headline -->
		<div class="headline">
			<h3><i class="icon-material-outline-account-circle"></i> Verify Your purchase</h3>
		</div>
        <form method="post">
		<div class="content with-padding padding-bottom-0">

			<div class="row">
				<div class="col">
					<div class="row" style="display: contents;">
                    
						<div class="col-xl-12">
							<div class="submit-field">
								<h5>Verification Code</h5>
								<input type="text" class="with-border" name="vcode" required placeholder="Type random value!">
							</div>
						</div>

						<div class="col-xl-12">
							<div class="submit-field">
								<h5>Codecanone username</h5>
								<input type="text" class="with-border" name="uname" placeholder="Type random value!" required>
							</div>
						</div>

                        <div class="col-xl-12">
							<div class="submit-field">
								<h5>Email</h5>
								<input type="text" class="with-border" name="email" required placeholder="Type random value!" required>
							</div>
						</div>    

						<div class="col-xl-12">
							<div class="submit-field">
								<h5>Domain</h5>
								<input type="text" class="with-border" name="domain" readonly value="<?php echo $_SERVER['HTTP_HOST']; ?>">
							</div>
						</div>
                        <hr>
                        <h3> Database setup </h3>
                        <div class="col-xl-12">
							<div class="submit-field">
								<h5>host</h5>
								<input type="text" class="with-border" name="host">
							</div>
						</div>

						<div class="col-xl-12">
							<div class="submit-field">
								<h5>Database Name</h5>
								<input type="text" class="with-border" name="database">
							</div>
						</div>

						<div class="col-xl-12">
							<div class="submit-field">
								<h5>Username</h5>
								<input type="text" class="with-border" name="username">
							</div>
						</div>

						<div class="col-xl-12">
							<div class="submit-field">
								<h5>Password</h5>
								<input type="text" class="with-border" name="password">
							</div>
						</div>

						<div class="col-md-12 submit-field test" style="text-align: center;">
    						<input type="hidden" name="verification" value="verification">
    						<button type="submit" class="button ripple-effect big margin-top-30 purchase1">Verify Purchase</a>
					    </div>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
</div>
<!-- Scripts ================================================== -->
    <script src="../assets/frontend/js/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.1.0/jquery-migrate.min.js"></script>
    <script src="../assets/frontend/js/mmenu.min.js"></script>
    <script src="../assets/frontend/js/tippy.all.min.js"></script>
    <script src="../assets/frontend/js/simplebar.min.js"></script>
    <script src="../assets/frontend/js/bootstrap-slider.min.js"></script>
    <script src="../assets/frontend/js/bootstrap-select.min.js"></script>
    <script src="../assets/frontend/js/snackbar.js"></script>
    <script src="../assets/frontend/js/clipboard.min.js"></script>
    <script src="../assets/frontend/js/counterup.min.js"></script>
    <script src="../assets/frontend/js/magnific-popup.min.js"></script>
    <script src="../assets/frontend/js/slick.min.js"></script>
    <script src="../assets/frontend/js/custom.js"></script>

</body>

</html>