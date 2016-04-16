<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="">
	<title>Send Email With Angular JS & PHP Mailer</title>
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="bower_components/components-font-awesome/css/font-awesome.css">
	<link rel="stylesheet" href="public/css/style.css">
</head>
<body>
	<!-- Begin page content -->
	<div class="container" ng-app="contactApp" ng-controller="contactController">
		<div class="col-md-8 col-md-push-2">
			<div class="form-area">
				<h3 style="margin-bottom: 25px; text-align: center;">{{ title }}</h3>

				<div class="alert alert-success" ng-show="messageSuccess">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Success!</strong> {{ messageSuccess }}
				</div>

				<div class="alert alert-danger" ng-show="messageFailed">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Error!</strong> {{ messageFailed }}
				</div>
				
				<form role="form" name="contactForm" novalidate>
					
					<div class="form-group">
						<div id="name-group" class="form-group" ng-class="{ 'has-error' : errorName }">
						<input type="text" name="fullname" ng-model="formData.fullname" class="form-control" placeholder="Name" required>
						<span class="help-block" ng-show="errorName">{{ errorName }}</span>
					</div>
					<div class="form-group">
						<div id="name-group" class="form-group" ng-class="{ 'has-error' : errorEmail }">
						<input type="email" name="email" ng-model="formData.email" class="form-control" placeholder="Email" required>
						<span class="help-block" ng-show="errorEmail">{{ errorEmail }}</span>
					</div>
					<div class="form-group">
						<div id="name-group" class="form-group" ng-class="{ 'has-error' : errorMobile }">
						<input type="text" name="mobile" ng-model="formData.mobile" class="form-control" placeholder="Mobile Number" required>
						<span class="help-block" ng-show="errorMobile">{{ errorMobile }}</span>
					</div>
					<div class="form-group">
						<div id="name-group" class="form-group" ng-class="{ 'has-error' : errorSubject }">
						<input type="text" name="subject" ng-model="formData.subject" class="form-control" placeholder="Subject" required>
						<span class="help-block" ng-show="errorSubject">{{ errorSubject }}</span>
					</div>
					<div class="form-group">
						<div id="name-group" class="form-group" ng-class="{ 'has-error' : errorContent }">
						<textarea name="content" ng-model="formData.content" class="form-control" type="textarea" placeholder="Message" maxlength="140" rows="7"></textarea>
						<span class="help-block" ng-show="errorContent">{{ errorContent }}</span>
					</div>

					<button type="button" class="btn btn-primary pull-right" ng-click="processForm(formData)">
						<span ng-hide="sendValue">
							Send
						</span>
						<span ng-show="sendValue">
							Sending.
							<i class="fa fa-spinner fa-spin fa-1x"></i>
						</span>
					</button>
				</form>
				
			</div>
		</div>
	</div>

	<script src="bower_components/jquery/dist/jquery.js"></script>
	<script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
	<script src="bower_components/angular/angular.js"></script>
	<script src="public/js/app.js"></script>
</body>
</html>
