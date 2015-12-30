<html>

    <head>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
        <link href='https://fonts.googleapis.com/css?family=Candal' rel='stylesheet' type='text/css'>
        <style type="text/css">
            .cntr{
                text-align: center;
            }
            .modal.large {
               text-align: center;
            }   
            .modal-title{
               text-align: left !important;
               font-size: 1.8em !important;
               font-family: 'Candal', sans-serif !important; 
               font-weight: 400 !important;
            }
            .checkbox{
                font-size: 1em !important;
                font-family: 'Candal', sans-serif !important; 
               font-weight: 400 !important;
            }
            .modal-header{
                background-color: rgb(255, 80, 80);
                color: white;
            }
            .ttl{
                text-align: center;
               font-size: 2.6em !important;
               font-family: 'Candal', sans-serif !important; 
               font-weight: 400 !important;  
               margin-top: 120px;
            }
        </style>
    </head>
    <body>
        <!-- Modal -->
        <div class="cntr">
        <h1 class="ttl">Every human has rights</h1>
        <button type="button" class="btn btn-primary btn-lg" id="login" style="background-color: #4e69a2; margin-top: 24px;">LOGIN WITH FACEBOOK</button>
        </div>
        <div class="modal fade large" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Share Picture</h4>
                    </div>
                    <div class="modal-body">
                        <img id="gen-img" src="screen1248.png" style="max-width: 100%"/>
                        <textarea style="width: 85%; margin: 16px auto;" class="form-control" rows="3" id="comment" placeholder="Say something about this"></textarea>
                        <div class="checkbox">
                          <label><input type="checkbox" value="">Set as my profile picture</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-lg" id="share" style="background-color: #4e69a2">POST ON FACEBOOK</button>
                        <button type="button" class="btn btn-default" id="close" data-dismiss="modal" style="display: none">Close</button>
                    </div>
                </div>
            </div>
        </div>

            <script type="text/javascript" defer>
                //async init once loading is done
                (function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id))
                        return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "https://connect.facebook.net/en_US/sdk.js";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
                window.fbAsyncInit = function () {
                    FB.init({
                        appId: '526365847530316',
                        xfbml: true,
                        cookie: true,
                        version: 'v2.1'
                    });
                };
                $('#login').click(function(){  
                    FB.getLoginStatus(function (response) {
                        if (response.status === 'connected' || response.status === 'not_authorized') {
                            FB.login(function (response) {
                                if (response.authResponse) {
                                    FB.api('/me', {fields: "id,email,name"}, function (resp) {
                                        $.ajax({
                                            url: '/image.php',
                                            type: 'post',
                                            data: resp,
                                            success: function(r) {
                                              $('#gen-img').attr('src', 'images/'+resp.id+'_Pic.png');
                                              $('.modal').modal('show');  
                                            }
                                        });
                                    });
                                } else {
//                                    window.location.reload();
                                }
                            }, {scope: 'publish_actions, email'});
                        } else {
                        }
                    });
                });
                
                    
                    
                    
                    $("#share").on("click", function () {
                      FB.api('/me/photos', 'post', {
                            url: 'image.png',
                            message: 'Upload demo'
                        }, function (response) {
                            if (response && response.id)
                                console.log('Photo uploaded', response.id);
                            else{
                              console.log(response);
                            }    
                        });  
                      $('#close').click();
                    });  
            </script>

    </body>