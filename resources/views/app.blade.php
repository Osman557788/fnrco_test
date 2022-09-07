
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="keywords" content="" />
	<title>Winku Social Network Toolkit</title>
    <link rel="icon" href="images/fav.png" type="image/png" sizes="16x16"> 
    
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">

</head>
<body>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">

	<section>
		<div class="gap gray-bg">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="row" id="page-contents">
							<div class="col-lg-3">
								
							</div><!-- sidebar -->
							<div class="col-lg-6">
								<div class="central-meta">
									<div class="new-postbox">
										<figure>
											<img src="images/resources/admin2.jpg" alt="">
										</figure>
										<div class="newpst-input">
											<form method="post" action="{{url('post')}}" enctype="multipart/form-data" >
                                                @if ($errors->any())
                                                    @foreach ($errors->all() as $error)
                                                    <div class="alert alert-danger">
                                                        <span class="danger">{{$error}}</span>
                                                    </div>    
                                                    @endforeach
                                                @endif
                                                @csrf
												<input class="mb-1 " name="title" rows="2" placeholder="write title"></input>
												<textarea rows="2" name="description" placeholder="write something"></textarea>
												<div class="attachments">
													<ul>
														<li>
															<i class="fa fa-image"></i>
															<label class="fileContainer">
																<input name="images[]" type="file"  multiple >
															</label>
														</li>
														<li>
															<button type="submit">Post</button>
														</li>
													</ul>
												</div>
											</form>
										</div>
									</div>
								</div><!-- add post new box -->
								<div class="loadMore">
                                @foreach ($posts as $post )
								<div class="central-meta item">
									<div class="user-post">
										<div class="friend-info">
                                            
											<figure>
												<img src="images/resources/friend-avatar10.jpg" alt="">
											</figure>
											<div class="friend-name">
												<ins><a href="time-line.html" title="">{{$post->user->name}}</a></ins>
												<span>published: {{$post->created_at}}</span>
											</div>
                                            <div class="dropdown float-right">
                                                <button class="btn btn-flat  btn-flat-icon" type="button" data-toggle="dropdown" aria-expanded="false">
                                                 <em class="fa fa-ellipsis-h"></em>
                                                </button>
                                                <div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu" style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <form method="post" action="{{route('post.destroy',$post->id)}}">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="record_ids" id="record-ids">
                                                        <button class="dropdown-item" type="submit" href="#">delete post</button>
                                                    </form><!-- end of form -->
                                                 
                                                </div>
                                               </div><!--/ dropdown -->
											<div class="post-meta">
                                                @foreach ($post->files as $file )

                                                    <img src="{{url('storage/post/'.$file->file)}}" alt="">
                                                
                                                @endforeach
												<div  class="we-video-info">
													<ul>
														
														<li>
															<span  class="comment" data-toggle="tooltip" title="Comments">
																<i class="fa fa-comments-o"></i>
																<ins>{{count($post->comments)}}</ins>
															</span>
														</li>
														<li>
                                                            @php
                                                                $islike ='' ;
                                                                foreach ($post->likes as $like ){

                                                                    if ($like ->user_id == auth()->id()) {

                                                                        $islike ='class=like' ;    
                                                                    }
                                                                    
                                                                    
                                                                }

                                                            @endphp
                                                            

															<span  {{$islike}}  post_id="{{$post->id}}"   data-toggle="tooltip" title="like">
																<i class="ti-heart"></i>
																<ins>{{count($post->likes)}}</ins>
															</span>
														</li>
														
														<li class="social-media">
															<div class="menu">
															  <div class="btn trigger"><i class="fa fa-share-alt"></i></div>
															  <div class="rotater">
																<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-html5"></i></a></div>
															  </div>
															  <div class="rotater">
																<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-facebook"></i></a></div>
															  </div>
															  <div class="rotater">
																<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-google-plus"></i></a></div>
															  </div>
															  <div class="rotater">
																<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-twitter"></i></a></div>
															  </div>
															  <div class="rotater">
																<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-css3"></i></a></div>
															  </div>
															  <div class="rotater">
																<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-instagram"></i></a>
																</div>
															  </div>
																<div class="rotater">
																<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-dribbble"></i></a>
																</div>
															  </div>
															  <div class="rotater">
																<div class="btn btn-icon"><a href="#" title=""><i class="fa fa-pinterest"></i></a>
																</div>
															  </div>

															</div>
														</li>
													</ul>
												</div>
												<div class="description">
													
													<p >
														{{$post->description}}
													</p>
												</div>
											</div>
										</div>
										<div class="coment-area">
											<ul class="we-comet">

                                                
                                                @foreach ($post->comments as $comment )
												<li>
													<div class="comet-avatar">
														<img src="images/resources/comet-1.jpg" alt="">
													</div>
													<div class="we-comment">
														<div class="coment-head">
															<h5><a href="time-line.html" title="">{{$comment->user->name}}</a></h5>
															<span>{{$comment->created_at}}</span>
															<a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
														</div>
														<p>{{$comment->comment}}</p>
													</div>
													
												</li>
                                                @endforeach
												<li>
													<a href="#" title="" class="showmore underline">more comments</a>
												</li>
												<li class="post-comment">
													<div class="comet-avatar">
														<img src="images/resources/comet-1.jpg" alt="">
													</div>
													<div class="post-comt-box">
														<form method="post">
															<textarea  id="textbox" name="comment" post_id="{{$post->id}}" placeholder="Post your comment"></textarea>
														</form>	
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
                                @endforeach 
								</div>
							</div><!-- centerl meta -->
						</div>	
					</div>
				</div>
			</div>
		</div>	
	</section>
    
	<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="js/main.min.js"></script>
	<script src="js/script.js"></script>
	<script src="js/map-init.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script>
    <script> 
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }   
        });

        $("span").click(function(){
            var elem = $(this);
            if(!$(this).attr('class')){
                var post_id = elem.attr('post_id');
                $.ajax({url: "postLike",type:'GET', 
                data:{post_id:post_id},
                success: function(result){
                    elem.addClass("like");
                    counter = elem.find('ins').text();
                    elem.find('ins').text( Number(counter) + 1);
                }});
            }

            
        });

		/** Post a Comment **/
		jQuery(".post-comt-box textarea").on("keydown", function (event) {
        if (event.keyCode == 13) {
			$.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}   
            });
			var elem = jQuery(this)
			var post_id = $('#textbox').attr('post_id');
            var comment = jQuery(this).val();
            var parent = jQuery(".showmore").parent("li");
			$.ajax({url: 'createComment',type:'Post', 
                data:{
                    comment:comment,
                    post_id:post_id,
                },
                success: function(result){
					console.log(result);

					var comment_HTML =
                '<li><div class="comet-avatar"><img src="images/resources/comet-1.jpg" alt=""></div><div class="we-comment"><div class="coment-head"><h5><a href="time-line.html" title="">'+result.name+'</a></h5><span>'+result.creates_at+'</span><a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a></div><p>' +
                comment +
                "</p></div></li>";
           		$(comment_HTML).insertBefore(parent);
            	elem.val("");
                   
            }});
            
        }
   		});
    </script>
</body>	

</html>