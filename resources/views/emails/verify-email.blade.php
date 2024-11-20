@extends('emails.layouts.app')
@section('title', 'Email verification')

@section('content')
<!-- Email Body -->
<tr>
	<td class="body" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #f5f8fa; border-bottom: 1px solid #f5f8fa; border-top: 1px solid #f5f8fa; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
		<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #ffffff; margin: 0 auto; padding: 0; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; border-radius: 30px;">
			<!-- Body content -->
			<tr>
				<td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">

					<h1 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">
						Hello {{ $user->first_name }},
					</h1>

					<p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
						An account has been created on the E-judgment website for you with the following details
						<br>
						<br>
						<em style="font-weight: bolder; color: #3d7881;">Username: {{ $user->username }}</em>
						<br>
						<em style="font-weight: bolder; color: #3d7881">Password: {{ config('judicial.default_password') }}</em>
					</p>

					<p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
					Please click the button below to login with the credentials above to verify and reset your password.</p>

					<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 30px auto; padding: 0; text-align: center; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
						<tr>
							<td align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
								<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
									<tr>
										<td align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
											<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
												<tr>
													<td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
														<a href="{{ $url }}" class="button button-green" target="_blank" rel="noopener" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); color: #ffffff; display: inline-block; text-decoration: none; -webkit-text-size-adjust: none; background-color: #3d7881; border-top: 10px solid #3d7881; border-right: 18px solid #3d7881; border-bottom: 10px solid #3d7881; border-left: 18px solid #3d7881;">
															Proceed
														</a>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>


					<table class="panel" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0 0 21px;">
						<tr>
							<td class="panel-content" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #edeff2; padding: 16px;">
								<table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
									<tr>
										<td class="panel-item" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 0;">
											<p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left; margin-bottom: 0; padding-bottom: 0;">If you did not create an account or request an an account, no further action is required.
											</p>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

					<p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
						Thanks,<br><br>

						E-judgment <br>
						Judicial Service of Ghana <br>
						Accra - Ghana <br>
					</p>


					<table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-top: 1px solid #edeff2; margin-top: 25px; padding-top: 25px;">
						<tr>
							<td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
								<p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; line-height: 1.5em; margin-top: 0; text-align: left; font-size: 12px;">
									If you’re having trouble clicking the "Proceed" button, copy and paste the URL below into your web browser: <br> 
									<span style="color: #6610f2">{{ $url }}</span>
								</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
@endsection

