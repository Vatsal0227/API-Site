<?php
function redirect ($uri)
{
?>
	<script type="text/javascript">
		<!--
		document.location.href="<?php echo $uri; ?>";
		-->
	</script>
<?php die;
}


function api_call ($api_name, $data="") {
	$ch=curl_init("https://ec2-18-116-30-237.us-east-2.compute.amazonaws.com/api/$api_name");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//ignore ssl
	curl_setopt($ch, CURLOPT_POST,1);//tell curl we are using post
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//this is the data
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//prepare a response
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'content-type: application/x-www-form-urlencoded',
		'content-length: '.strlen($data))
				);
	$result=curl_exec($ch);
	curl_close($ch);
	$nonjsonResult=json_decode($result,true);
	return $nonjsonResult;
}
?>

