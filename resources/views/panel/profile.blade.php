@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// Morris Charts CSS
		'vendors/bower_components/morris.js/morris.css',
		// vector map CSS
		'vendors/vectormap/jquery-jvectormap-2.0.2.css',
		// Calendar CSS
		'vendors/bower_components/fullcalendar/dist/fullcalendar.css',
		// Data table CSS
		'vendors/bower_components/datatables/media/css/jquery.dataTables.min.css',
		// Custom CSS
		'dist/css/style.css',
	]; ?>

	@foreach ($styles as $style)
		<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
	@endforeach
@endsection
	
@section('content')
	<div class="container pt-30">
		<!-- Row -->
		<div class="row">
			<div class="col-sm-4">
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default card-view  pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body  pa-0">
									<div class="profile-box">
										<div class="profile-cover-pic">
											<div class="fileupload btn btn-default">
												<span class="btn-text">edit</span>
												<input class="upload" type="file">
											</div>
											<div class="profile-image-overlay"></div>
										</div>
										<div class="profile-info text-center mb-15">
											<div class="profile-img-wrap">
												<img class="inline-block mb-10" src="../img/mock1.jpg" alt="user"/>
												<div class="fileupload btn btn-default">
													<span class="btn-text">edit</span>
													<input class="upload" type="file">
												</div>
											</div>	
											<h5 class="block mt-10 weight-500 capitalize-font txt-dark">Madalyn Rascon</h5>
											<h6 class="block capitalize-font">Developer Geek</h6>
										</div>	
										<div class="social-info">
											<div class="row">
												<div class="col-xs-4 text-center">
													<span class="counts block head-font"><span class="counter-anim">345</span></span>
													<span class="counts-text block">post</span>
												</div>
												<div class="col-xs-4 text-center">
													<span class="counts block head-font"><span class="counter-anim">246</span></span>
													<span class="counts-text block">followers</span>
												</div>
												<div class="col-xs-4 text-center">
													<span class="counts block head-font"><span class="counter-anim">898</span></span>
													<span class="counts-text block">tweets</span>
												</div>
											</div>
											<button class="btn btn-default btn-block  btn-anim mt-15 bg-grad-danger" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil txt-light"></i><span class="btn-text txt-light">edit profile</span></button>
											<div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<h5 class="modal-title" id="myModalLabel">Edit Profile</h5>
														</div>
														<div class="modal-body">
															<!-- Row -->
															<div class="row">
																<div class="col-lg-12">
																	<div class="">
																		<div class="panel-wrapper collapse in">
																			<div class="panel-body pa-0">
																				<div class="col-sm-12 col-xs-12">
																					<div class="form-wrap">
																						<form action="#">
																							<div class="form-body overflow-hide">
																								<div class="form-group">
																									<label class="control-label mb-10" for="exampleInputuname_1">Name</label>
																									<div class="input-group">
																										<div class="input-group-addon"><i class="icon-user"></i></div>
																										<input type="text" class="form-control" id="exampleInputuname_1" placeholder="willard bryant">
																									</div>
																								</div>
																								<div class="form-group">
																									<label class="control-label mb-10" for="exampleInputEmail_1">Email address</label>
																									<div class="input-group">
																										<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
																										<input type="email" class="form-control" id="exampleInputEmail_1" placeholder="xyz@gmail.com">
																									</div>
																								</div>
																								<div class="form-group">
																									<label class="control-label mb-10" for="exampleInputContact_1">Contact number</label>
																									<div class="input-group">
																										<div class="input-group-addon"><i class="icon-phone"></i></div>
																										<input type="email" class="form-control" id="exampleInputContact_1" placeholder="+102 9388333">
																									</div>
																								</div>
																								<div class="form-group">
																									<label class="control-label mb-10" for="exampleInputpwd_1">Password</label>
																									<div class="input-group">
																										<div class="input-group-addon"><i class="icon-lock"></i></div>
																										<input type="password" class="form-control" id="exampleInputpwd_1" placeholder="Enter pwd" value="password">
																									</div>
																								</div>
																								<div class="form-group">
																									<label class="control-label mb-10">Gender</label>
																									<div>
																										<div class="radio">
																											<input type="radio" name="radio1" id="radio_1" value="option1" checked="">
																											<label for="radio_1">
																											M
																											</label>
																										</div>
																										<div class="radio">
																											<input type="radio" name="radio1" id="radio_2" value="option2">
																											<label for="radio_2">
																											F
																											</label>
																										</div>
																									</div>
																								</div>
																								<div class="form-group">
																									<label class="control-label mb-10">Country</label>
																									<select class="form-control" data-placeholder="Choose a Category" tabindex="1">
																										<option value="Category 1">USA</option>
																										<option value="Category 2">Austrailia</option>
																										<option value="Category 3">India</option>
																										<option value="Category 4">UK</option>
																									</select>
																								</div>
																							</div>
																							<div class="form-actions mt-10">			
																								<button type="submit" class="btn btn-default mr-10 mb-30">Update profile</button>
																							</div>				
																						</form>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-orange waves-effect" data-dismiss="modal">Save</button>
															<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
														</div>
													</div>
													<!-- /.modal-content -->
												</div>
												<!-- /.modal-dialog -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Instagram</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div  class="panel-body row pa-0">
									<!--Instagram-->
									<ul class="instagram-lite"></ul>
									<!--/Instagram-->
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-sm-12">
						<div class="panel panel-default card-view bg-twitter">
							<div class="panel-wrapper collapse in">
								<div  class="panel-body">
									<div class="twitter-icon-wrap text-center mb-15">
										<i class="fa fa-twitter"></i>
									</div>
									<!-- START carousel-->
									<div id="twitter_slider" data-ride="carousel" class="carousel slide twitter-slider-wrap text-slider">
										<ol class="carousel-indicators">
										<li data-target="#twitter_slider" data-slide-to="0" class="active"></li>
										<li data-target="#twitter_slider" data-slide-to="1"></li>
										</ol>
										<div id="tweets_fetch" role="listbox" class="carousel-inner mb-50">
										</div>
									</div>
									<!-- END carousel-->
								</div>
							</div>
						</div>
					</div>
				</div>	
			</div>	
			<div class="col-sm-8">
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div  class="panel-body pb-0">
									<div  class="tab-struct custom-tab-1">
										<ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
											<li class="active" role="presentation"><a  data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>profile</span></a></li>
											<li  role="presentation" class="next"><a aria-expanded="true"  data-toggle="tab" role="tab" id="follo_tab_8" href="#follo_8"><span>followers<span class="inline-block">(246)</span></span></a></li>
											<li role="presentation" class=""><a  data-toggle="tab" id="photos_tab_8" role="tab" href="#photos_8" aria-expanded="false"><span>photos</span></a></li>
											<li role="presentation" class=""><a  data-toggle="tab" id="earning_tab_8" role="tab" href="#earnings_8" aria-expanded="false"><span>earnings</span></a></li>
											<li role="presentation" class=""><a  data-toggle="tab" id="settings_tab_8" role="tab" href="#settings_8" aria-expanded="false"><span>settings</span></a></li>
											<li class="dropdown" role="presentation">
												<a  data-toggle="dropdown" class="dropdown-toggle" id="myTabDrop_7" href="#" aria-expanded="false"><span>More</span> <span class="caret"></span></a>
												<ul id="myTabDrop_7_contents"  class="dropdown-menu">
													<li class=""><a  data-toggle="tab" id="dropdown_13_tab" role="tab" href="#dropdown_13" aria-expanded="true">About</a></li>
													<li class=""><a  data-toggle="tab" id="dropdown_14_tab" role="tab" href="#dropdown_14" aria-expanded="false">Followings</a></li>
													<li class=""><a  data-toggle="tab" id="dropdown_15_tab" role="tab" href="#dropdown_15" aria-expanded="false">Likes</a></li>
													<li class=""><a  data-toggle="tab" id="dropdown_16_tab" role="tab" href="#dropdown_16" aria-expanded="false">Reviews</a></li>
												</ul>
											</li>
										</ul>
										<div class="tab-content" id="myTabContent_8">
											<div  id="profile_8" class="tab-pane fade active in" role="tabpanel">
												<div class="col-md-12">
													<div class="pt-20">
														<div class="streamline user-activity">
															<div class="sl-item">
																<a href="javascript:void(0)">
																	<div class="sl-avatar avatar avatar-sm avatar-circle">
																		<span class="bg-grad-primary txt-light">C</span>
																	</div>
																	<div class="sl-content">
																		<p class="inline-block"><span class="capitalize-font txt-primary mr-5 weight-500">Clay Masse</span><span>invited to join the meeting in the conference room at 9.45 am</span></p>
																		<span class="block txt-grey font-12 capitalize-font">3 Min</span>
																	</div>
																</a>
															</div>

															<div class="sl-item">
																<a href="javascript:void(0)">
																	<div class="sl-avatar avatar avatar-sm avatar-circle">
																		<img class="img-responsive img-circle" src="../img/user1.png" alt="avatar"/>
																	</div>
																	<div class="sl-content">
																		<p class="inline-block"><span class="capitalize-font txt-primary mr-5 weight-500">Evie Ono</span><span>added three new photos in the library</span></p>
																		<div class="activity-thumbnail">
																			<img src="../img/thumb-1.jpg" alt="thumbnail"/>
																			<img src="../img/thumb-2.jpg" alt="thumbnail"/>
																			<img src="../img/thumb-3.jpg" alt="thumbnail"/>
																		</div>
																		<span class="block txt-grey font-12 capitalize-font">8 Min</span>
																	</div>
																</a>	
															</div>

															<div class="sl-item">
																<a href="javascript:void(0)">
																	<div class="sl-avatar avatar avatar-sm avatar-circle">
																		<span class="bg-grad-success txt-light">M</span>
																	</div>
																	<div class="sl-content">
																		<p class="inline-block"><span class="capitalize-font txt-primary mr-5 weight-500">madalyn rascon</span><span>assigned a new task</span></p>
																		<span class="block txt-grey font-12 capitalize-font">28 Min</span>
																	</div>
																</a>	
															</div>

															<div class="sl-item">
																<a href="javascript:void(0)">
																	<div class="sl-avatar avatar avatar-sm avatar-circle">
																		<img class="img-responsive img-circle" src="../img/user3.png" alt="avatar"/>
																	</div>
																	<div class="sl-content">
																		<p class="inline-block"><span class="capitalize-font txt-primary mr-5 weight-500">Ezequiel Merideth</span><span>completed project wireframes</span></p>
																		<span class="block txt-grey font-12 capitalize-font">yesterday</span>
																	</div>
																</a>	
															</div>
															
															<div class="sl-item">
																<a href="javascript:void(0)">
																	<div class="sl-avatar avatar avatar-sm avatar-circle">
																		<span class="bg-grad-success txt-light">J</span>
																	</div>
																	<div class="sl-content">
																		<p class="inline-block"><span class="capitalize-font txt-primary mr-5 weight-500">jonnie metoyer</span><span>created a group 'Hencework' in the discussion forum</span></p>
																		<span class="block txt-grey font-12 capitalize-font">18 feb</span>
																	</div>
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
											
											<div  id="follo_8" class="tab-pane fade" role="tabpanel">
												<div class="row">
													<div class="col-lg-12">
														<div class="followers-wrap">
															<ul class="followers-list-wrap">
																<li class="follow-list">
																	<div class="follo-body">
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="../img/user.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Clay Masse</span>
																				<span class="time block truncate txt-grey">No one saves us but ourselves.</span>
																			</div>
																			<button class="btn btn-default pull-right btn-xs fixed-btn">Follow</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="../img/user1.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Evie Ono</span>
																				<span class="time block truncate txt-grey">Unity is strength</span>
																			</div>
																			<button class="btn btn-default btn-outline pull-right btn-xs fixed-btn">following</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="../img/user2.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Madalyn Rascon</span>
																				<span class="time block truncate txt-grey">Respect yourself if you would have others respect you.</span>
																			</div>
																			<button class="btn btn-default btn-outline pull-right btn-xs fixed-btn">following</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="../img/user3.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Mitsuko Heid</span>
																				<span class="time block truncate txt-grey">I’m thankful.</span>
																			</div>
																			<button class="btn btn-default pull-right btn-xs fixed-btn">Follow</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="../img/user.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Ezequiel Merideth</span>
																				<span class="time block truncate txt-grey">Patience is bitter.</span>
																			</div>
																			<button class="btn btn-default pull-right btn-xs fixed-btn">Follow</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="../img/user1.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Jonnie Metoyer</span>
																				<span class="time block truncate txt-grey">Genius is eternal patience.</span>
																			</div>
																			<button class="btn btn-default btn-outline pull-right btn-xs fixed-btn">following</button>
																			<div class="clearfix"></div>
																		</div>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
											<div  id="photos_8" class="tab-pane fade" role="tabpanel">
												<div class="col-md-12 pb-20">
													<div class="gallery-wrap">
														<div class="portfolio-wrap project-gallery">
															<ul id="portfolio_1" class="portf auto-construct  project-gallery" data-col="4">
																<li  class="item"   data-src="../img/gallery/equal-size/mock1.jpg" data-sub-html="<h6>Bagwati</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>" >
																	<a href="">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock1.jpg"  alt="Image description" />
																	<span class="hover-cap">Bagwati</span>
																	</a>
																</li>
																<li class="item" data-src="../img/gallery/equal-size/mock2.jpg"   data-sub-html="<h6>Not a Keyboard</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock2.jpg"  alt="Image description" />
																	<span class="hover-cap">Not a Keyboard</span>
																	</a>
																</li>
																<li class="item" data-src="../img/gallery/equal-size/mock3.jpg" data-sub-html="<h6>Into the Woods</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock3.jpg"  alt="Image description" />
																	<span class="hover-cap">Into the Woods</span>
																	</a>
																</li>
																<li class="item" data-src="../img/gallery/equal-size/mock4.jpg"  data-sub-html="<h6>Ultra Saffire</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock4.jpg"  alt="Image description" />
																	<span class="hover-cap"> Ultra Saffire</span>
																	</a>
																</li>
																
																<li class="item" data-src="../img/gallery/equal-size/mock5.jpg" data-sub-html="<h6>Happy Puppy</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock5.jpg"  alt="Image description" />	
																	<span class="hover-cap">Happy Puppy</span>
																	</a>
																</li>
																<li class="item" data-src="../img/gallery/equal-size/mock6.jpg"  data-sub-html="<h6>Wooden Closet</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock6.jpg"  alt="Image description" />
																	<span class="hover-cap">Wooden Closet</span>
																	</a>
																</li>
																<li class="item" data-src="../img/gallery/equal-size/mock7.jpg" data-sub-html="<h6>Happy Puppy</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock7.jpg"  alt="Image description" />	
																	<span class="hover-cap">Happy Puppy</span>
																	</a>
																</li>
																<li class="item" data-src="../img/gallery/equal-size/mock8.jpg"  data-sub-html="<h6>Wooden Closet</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock8.jpg"  alt="Image description" />
																	<span class="hover-cap">Wooden Closet</span>
																	</a>
																</li>
															</ul>
														</div>
													</div>
												</div>	
											</div>
											<div  id="earnings_8" class="tab-pane fade" role="tabpanel">
												<!-- Row -->
												<div class="row">
													<div class="col-lg-12">
														<form id="example-advanced-form" action="#">
															<div class="table-wrap">
																<div class="table-responsive">
																	<table class="table table-striped display product-overview" id="datable_1">
																		<thead>
																			<tr>
																				<th>Date</th>
																				<th>Item Sales Colunt</th>
																				<th>Earnings</th>
																			</tr>
																		</thead>
																		<tfoot>
																			<tr>
																				<th colspan="2">total:</th>
																				<th></th>
																			</tr>
																		</tfoot>
																		<tbody>
																			<tr>
																				<td>monday, 12</td>
																				<td>
																				3
																				</td>
																				<td>$400</td>
																			</tr>
																			<tr>
																				<td>tuesday, 13</td>
																				<td>
																				2
																				</td>
																				<td>$400</td>
																			</tr>
																			<tr>
																				<td>wednesday, 14</td>
																				<td>
																				3
																				</td>
																				<td>$420</td>
																			</tr>
																			<tr>
																				<td>thursday, 15</td>
																				<td>
																				5
																				</td>
																				<td>$500</td>
																			</tr>
																			<tr>
																				<td>friday, 15</td>
																				<td>
																				3
																				</td>
																				<td>$400</td>
																			</tr>
																			<tr>
																				<td>saturday, 16</td>
																				<td>
																				3
																				</td>
																				<td>$400</td>
																			</tr>
																			<tr>
																				<td>sunday, 17</td>
																				<td>
																				3
																				</td>
																				<td>$400</td>
																			</tr>
																			<tr>
																				<td>monday, 18</td>
																				<td>
																				3
																				</td>
																				<td>$500</td>
																			</tr>
																			<tr>
																				<td>tuesday, 19</td>
																				<td>
																				3
																				</td>
																				<td>$400</td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
											<div  id="settings_8" class="tab-pane fade" role="tabpanel">
												<!-- Row -->
												<div class="row">
													<div class="col-lg-12">
														<div class="">
															<div class="panel-wrapper collapse in">
																<div class="panel-body pa-0">
																	<div class="col-sm-12 col-xs-12">
																		<div class="form-wrap">
																			<form action="#">
																				<div class="form-body overflow-hide">
																					<div class="form-group">
																						<label class="control-label mb-10" for="exampleInputuname_01">Name</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-user"></i></div>
																							<input type="text" class="form-control" id="exampleInputuname_01" placeholder="willard bryant">
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="control-label mb-10" for="exampleInputEmail_01">Email address</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
																							<input type="email" class="form-control" id="exampleInputEmail_01" placeholder="xyz@gmail.com">
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="control-label mb-10" for="exampleInputContact_01">Contact number</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-phone"></i></div>
																							<input type="email" class="form-control" id="exampleInputContact_01" placeholder="+102 9388333">
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="control-label mb-10" for="exampleInputpwd_01">Password</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-lock"></i></div>
																							<input type="password" class="form-control" id="exampleInputpwd_01" placeholder="Enter pwd" value="password">
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="control-label mb-10">Gender</label>
																						<div>
																							<div class="radio">
																								<input type="radio" name="radio1" id="radio_01" value="option1" checked="">
																								<label for="radio_01">
																								M
																								</label>
																							</div>
																							<div class="radio">
																								<input type="radio" name="radio1" id="radio_02" value="option2">
																								<label for="radio_02">
																								F
																								</label>
																							</div>
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="control-label mb-10">Country</label>
																						<select class="form-control" data-placeholder="Choose a Category" tabindex="1">
																							<option value="Category 1">USA</option>
																							<option value="Category 2">Austrailia</option>
																							<option value="Category 3">India</option>
																							<option value="Category 4">UK</option>
																						</select>
																					</div>
																				</div>
																				<div class="form-actions mt-10">			
																					<button type="submit" class="btn btn-default mr-10 mb-30">Update profile</button>
																				</div>				
																			</form>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-xs-12">
						<div class="panel panel-default border-panel card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">todo</h6>
								</div>
								<div class="pull-right">
									<div class="pull-left inline-block dropdown mr-15">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
										<ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>Edit</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>Clear All</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>Select All</a></li>
										</ul>
									</div>
									<a class="pull-left inline-block close-panel" href="#" data-effect="fadeOut">
										<i class="zmdi zmdi-close"></i>
									</a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row pa-0">
									<div class="todo-box-wrap">
										<!-- Todo-List -->
										<ul class="todo-list todo-box-nicescroll-bar">
											<li class="todo-item">
												<div class="checkbox checkbox-default">
													<input type="checkbox" id="checkbox001"/>
													<label for="checkbox001">Record The First Episode</label>
												</div>
											</li>
											<li>
												<hr class="light-grey-hr"/>
											</li>
											<li class="todo-item">
												<div class="checkbox checkbox-pink">
													<input type="checkbox" id="checkbox002"/>
													<label for="checkbox002">Prepare The Conference Schedule</label>
												</div>
											</li>
											<li>
												<hr class="light-grey-hr"/>
											</li>
											<li class="todo-item">
												<div class="checkbox checkbox-warning">
													<input type="checkbox" id="checkbox003" checked/>
													<label for="checkbox003">Decide The Live Discussion Time</label>
												</div>
											</li>
											<li>
												<hr class="light-grey-hr"/>
											</li>
											<li class="todo-item">
												<div class="checkbox checkbox-success">
													<input type="checkbox" id="checkbox004" checked/>
													<label for="checkbox004">Prepare For The Next Project</label>
												</div>
											</li>
											<li>
												<hr class="light-grey-hr"/>
											</li>
											<li class="todo-item">
												<div class="checkbox checkbox-danger">
													<input type="checkbox" id="checkbox005" checked/>
													<label for="checkbox005">Finish Up AngularJs Tutorial</label>
												</div>
											</li>
											<li>
												<hr class="light-grey-hr"/>
											</li>
											<li class="todo-item">
												<div class="checkbox checkbox-purple">
													<input type="checkbox" id="checkbox006" checked/>
													<label for="checkbox006">Finish Infinity Project</label>
												</div>
											</li>
											<li>
												<hr class="light-grey-hr"/>
											</li>
										</ul>
										<!-- /Todo-List -->
										
										<!-- New Todo -->
										<div class="new-todo">
											<div class="input-group">
												<input type="text" id="add_todo" name="example-input2-group2" class="form-control" placeholder="Add new task">
												<span class="input-group-btn">
												<button type="button" class="btn btn-success"><i class="zmdi zmdi-plus txt-success"></i></button>
												</span> 
											</div>
										</div>
										<!-- /New Todo -->
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-xs-12">
						<div class="panel panel-default card-view">
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="calendar-wrap">
									<div id="calendar_small" class="small-calendar"></div>
									</div>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>	
		<!-- /Row -->
	</div>
@endsection

@section('scripts')
	<?php $scripts = [
		// jQuery
		'vendors/bower_components/jquery/dist/jquery.min.js',
		// Bootstrap Core JavaScript
		'vendors/bower_components/bootstrap/dist/js/bootstrap.min.js',
		// Vector Maps JavaScript
		'vendors/vectormap/jquery-jvectormap-2.0.2.min.js',
		'vendors/vectormap/jquery-jvectormap-world-mill-en.js',
		'dist/js/vectormap-data.js',
		// Calender JavaScripts
		'vendors/bower_components/moment/min/moment.min.js',
		'vendors/jquery-ui.min.js',
		'vendors/bower_components/fullcalendar/dist/fullcalendar.min.js',
		'dist/js/fullcalendar-data.js',
		// Counter Animation JavaScript
		'vendors/bower_components/waypoints/lib/jquery.waypoints.min.js',
		'vendors/bower_components/jquery.counterup/jquery.counterup.min.js',
		// Data table JavaScript
		'vendors/bower_components/datatables/media/js/jquery.dataTables.min.js',
		// Slimscroll JavaScript
		'dist/js/jquery.slimscroll.js',
		// Fancy Dropdown JS
		'dist/js/dropdown-bootstrap-extended.js',
		// Sparkline JavaScript
		'vendors/jquery.sparkline/dist/jquery.sparkline.min.js',
		'vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js',
		'dist/js/skills-counter-data.js',
		// Morris Charts JavaScript
		'vendors/bower_components/raphael/raphael.min.js',
		'vendors/bower_components/morris.js/morris.min.js',
		'dist/js/morris-data.js',
		// Owl JavaScript
		'vendors/bower_components/owl.carousel/dist/owl.carousel.min.js',
		// Switchery JavaScript
		'vendors/bower_components/switchery/dist/switchery.min.js',
		// Data table JavaScript
		'vendors/bower_components/datatables/media/js/jquery.dataTables.min.js',
		// Gallery JavaScript
		'dist/js/isotope.js',
		'dist/js/lightgallery-all.js',
		'dist/js/froogaloop2.min.js',
		'dist/js/gallery-data.js',
		// twitter JavaScript
		'dist/js/twitterFetcher.js',
		// Spectragram JavaScript
		'dist/js/spectragram.min.js',
		// Init JavaScript
		'dist/js/init.js',
		'dist/js/widgets-data.js',
	]; ?>

	@foreach ($scripts as $script)
		<script src="{{ asset($script) }}"></script>
	@endforeach
@endsection