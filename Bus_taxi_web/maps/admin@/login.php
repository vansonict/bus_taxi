<?php

	session_start();

	if (isset($_SESSION['user'])){

		header('Location: daily.php');

	} else {

?>
<html>

<head>

<meta http-equiv="Content-Language" content="en-us">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Login</title>



<style type="text/css">

<!--

td {font-family: Tahoma, Verdana, Arial; color: #FFFFFF; font-size: 11px}

a:link {color:#004E9B;text-decoration:none}

a:visited {color:#004E9B;text-decoration:none}

a:hover {color:#000000;text-decoration:none}

-->

</style>



</head>
<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" onselectstart="return false" oncontextmenu="return false">

<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" bgcolor="#5A7EDC">

	<tr>

		<td align="center">

		



<!-- BEGIN LOGIN FORM -->

<table border="0" cellpadding="0" cellspacing="0" width="400">			

			<tr>

				<td>

				<table border="0" cellpadding="0" cellspacing="0" width="100%">

					<tr>

						<td width="90" valign="top">

						<table border="0" cellpadding="0" cellspacing="0" width="90" height="87">

							<tr>

								<td width="8">

								<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">

									<tr>

										<td height="8">

										<img border="0" src="images/login_conner_topleft.gif" width="8" height="8"></td>

									</tr>

									<tr>

										<td style="background-image: url('images/login_border_left.gif'); background-repeat: repeat-y; background-position-x: left">&nbsp;</td>

									</tr>

									<tr>

										<td height="8">

										<img border="0" src="images/login_conner_bottomleft.gif" width="8" height="8"></td>

									</tr>

								</table>

								</td>

								<td>

								<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">

									<tr>

										<td bgcolor="#9CB2EA" height="1"></td>

									</tr>

									<tr>

										<td style="padding-left: 12px; padding-right: 8px; padding-top: 5px; padding-bottom: 5px" bgcolor="#1242A6">

										<img border="0" src="images/login_avatar.gif" width="52" height="52"></td>

									</tr>

									<tr>

										<td bgcolor="#9CB2EA" height="1"></td>

									</tr>

								</table>

								</td>

							</tr>

						</table>

						</td>

						<td valign="top">

						<table border="0" cellpadding="0" cellspacing="0" width="100%">

							<tr>

								<td style="background-image: url('images/login_border_top.gif'); background-repeat: repeat-y; background-position-x: left" height="1">

								</td>

							</tr>

							<tr>

								<td style="background-image: url('images/login_form_bg.gif'); background-repeat: repeat-y; background-position: left top" valign="top">

								<table border="0" cellpadding="0" cellspacing="0" width="100%">

									<Form name="frmLogin" method="post" action="etc/check_login.php">

									<tr>

										<td style="padding-top: 10px; padding-bottom: 3px">Type your username:</td>

									</tr>

									<tr>

										<td>

										<table border="0" cellpadding="0" cellspacing="0" width="155" height="26">

											<tr>

												<td width="3">

												<table border="0" cellpadding="0" cellspacing="0" width="100%" height="26">

													<tr>

														<td>

														<img border="0" src="images/login_input_conner_topleft.gif" width="3" height="3"></td>

													</tr>

													<tr>

														<td bgcolor="#FFFFFF" height="18"></td>

													</tr>

													<tr>

														<td><img border="0" src="images/login_input_conner_bottomle1.gif" width="3" height="5"></td>

													</tr>

												</table>

												</td>

												<td bgcolor="#FFFFFF">

												<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">

													<tr>

														<td>

														<input type="text" name="username" size="20" style="border: 1px solid #FFFFFF; width:145; height:20"></td>

													</tr>

													<tr>

														<td style="background-image: url('images/login_input_border_bottom.gif'); background-repeat: repeat-x" height="2">

														</td>

													</tr>

												</table>

												</td>

												<td width="5">

												<table border="0" cellpadding="0" cellspacing="0" width="100%" height="26">

													<tr>

														<td valign="top">

														<img border="0" src="images/login_input_conner_topright.gif" width="5" height="3"></td>

													</tr>

													<tr>

														<td style="background-image: url('images/login_input_border_right.gif'); background-repeat: repeat-y" height="18"></td>

													</tr>

													<tr>

														<td valign="bottom">

														<img border="0" src="images/login_input_conner_bottomri1.gif" width="5" height="5"></td>

													</tr>

												</table>

												</td>

											</tr>

										</table>										

										</td>

									</tr>

									<tr>

										<td style="padding-top: 7px; padding-bottom: 3px">Type your password:</td>

									</tr>

									<tr>

										<td>

										<table border="0" cellpadding="0" cellspacing="0" width="100%">

											<tr>

												<td width="155">

												<table border="0" cellpadding="0" cellspacing="0" width="155" height="26">

													<tr>

														<td width="3">

														<table border="0" cellpadding="0" cellspacing="0" width="100%" height="24">

															<tr>

																<td>

																<img border="0" src="images/login_input_conner_topleft.gif" width="3" height="3"></td>

															</tr>

															<tr>

																<td bgcolor="#FFFFFF" height="18"></td>

															</tr>

															<tr>

																<td><img border="0" src="images/login_input_conner_bottomle.gif" width="3" height="5"></td>

															</tr>

														</table>

														</td>

														<td bgcolor="#FFFFFF">

														<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">

															<tr>

																<td>

																<input type="password" name="password" size="20" style="border: 1px solid #FFFFFF; width:145; height:20">

																</td>

															</tr>

															<tr>

																<td style="background-image: url('images/login_input_border_bottom.gif'); background-repeat: repeat-x" height="2">

																</td>

															</tr>

														</table>

														</td>

														<td width="5">

														<table border="0" cellpadding="0" cellspacing="0" width="100%" height="24">

															<tr>

																<td valign="top">

																<img border="0" src="images/login_input_conner_topright.gif" width="5" height="3"></td>

															</tr>

															<tr>

																<td style="background-image: url('images/login_input_border_right.gif'); background-repeat: repeat-y" height="18"></td>

															</tr>

															<tr>

																<td valign="bottom">

																<img border="0" src="images/login_input_conner_bottomri.gif" width="5" height="5"></td>

															</tr>

														</table>

														</td>

													</tr>

												</table>

												</td>

												<td width="10">

												<table border="0" cellpadding="0" cellspacing="0" width="100%">

													<tr>

														<td height="10"></td>

													</tr>

													<tr>

														<td>

														<img border="0" src="images/login_form_line1.gif" width="10" height="1"></td>

													</tr>

													<tr>

														<td bgcolor="#5A7EDC" height="15"></td>

													</tr>

												</table>

												</td>

												<td width="26">

												<table border="0" cellpadding="0" cellspacing="0" width="100%">

													<tr>

														<td bgcolor="#5A7EDC">

														<input type="image" src="images/login_btn_arr.gif" alt="Login"></td>

													</tr>

												</table>

												</td>

												<td width="6">

												<table border="0" cellpadding="0" cellspacing="0" width="100%">

													<tr>

														<td height="10"></td>

													</tr>

													<tr>

														<td>

														<img border="0" src="images/login_form_line2.gif"></td>

													</tr>

													<tr>

														<td bgcolor="#5A7EDC" height="15"></td>

													</tr>

												</table>

												</td>

												<td width="26" bgcolor="#5A7EDC">

												<img alt="Forgot password?" border="0" src="images/login_btn_ask.gif" width="26" height="26" style="cursor:hand" onClick="dlgForgotPass()"></td>

												<td>

												<table border="0" cellpadding="0" cellspacing="0" width="100%">

													<tr>

														<td height="10"></td>

													</tr>

													<tr>

														<td bgcolor="#5A7EDC">

														<img border="0" src="images/login_form_line3.gif"></td>

													</tr>

													<tr>

														<td bgcolor="#5A7EDC" height="15"></td>

													</tr>

												</table>

												</td>

											</tr>

										</table>

										</td>

									</tr>

									</Form>

								</table>

								</td>

							</tr>

						</table>

						</td>

					</tr>

				</table>

				</td>

			</tr>

			<tr>

				<td align="center" style="padding-top: 10px">

				</td>

			</tr>

		</table>

        

<!-- END LOGIN FORM -->

		</td>

	</tr>

</table>

<?php

}

?>

</body>



</html>



