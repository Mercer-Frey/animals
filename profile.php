<?php require_once '/core/config.php'?>
<?php require_once '/core/function.php'?>
<?php 
if(isset($_GET['id']) AND $_GET['id'] != '' AND $_GET['id'] > 0){
    $conn = connect(); 
    $profile_data = selectProfileData($conn);
    close($conn);
    ($profile_data['time_last_online'] < time() - 30 OR $profile_data['time_last_online'] === '') ? $status_profile = '<span>Offline</span>' : $status_profile = "<span class='text-success'>Online</span>";
    ($profile_data['sex'] === 'male' AND $profile_data['sex'] !== '') ? $photo_profile = 'male' : $photo_profile = 'female';
} else header('Location: /404');
if($profile_data['id'] === NULL) header('Location: /404');
?>
<?php require_once('/template/header.php');?>
<div class="container">
	<div class="row">
		<div class="col-lg-4 offset-4">
			<p class="profile-status text-right"><?php echo $status_profile?></p>
			<div class="profile-photo"><img src="/profile/img/<?php echo $photo_profile?>-placeholder.jpg" alt="<?php echo $profile_data['login']?>"></div>	
			<table class="table table-striped mt-2">
				<thead>
					<tr>
						<th class="text-left">Data</th>
						<th class="text-right">Value</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="profile-data">id</td>
						<td class="profile-value"><?php echo $profile_data['id']?></td>
					</tr>
					<tr>
						<td class="profile-data">login</td>
						<td class="profile-value"><?php echo $profile_data['login']?></td>
					</tr>
					<tr>
						<td class="profile-data">email</td>
						<td class="profile-value"><?php echo $profile_data['email']?></td>
					</tr>
					<tr>
						<td class="profile-data">data sign up</td>
						<td class="profile-value"><?php echo $profile_data['FROM_UNIXTIME(time_sign_up)']?></td>
					</tr>
					<tr>
						<td class="profile-data">data last online</td>
						<td class="profile-value"><?php echo $profile_data['FROM_UNIXTIME(time_last_online)']?></td>
					</tr>
					<tr>
						<td class="profile-data">ip adress</td>
						<td class="profile-value"><?php echo $profile_data['INET_NTOA(ip)']?></td>
					</tr>
					<tr>
						<td class="profile-data">sex</td>
						<td class="profile-value"><?php echo $profile_data['sex']?></td>
					</tr>

			    </tbody>
			</table>
		</div>
		<!-- /.col-lg-4 offset-4 -->
	</div>
	<!-- /.row -->
</div>
<!-- /.container -->
<?php require_once('template/footer.php');?>