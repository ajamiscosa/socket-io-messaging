<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->

        <link rel="stylesheet" href="css/app.css">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <br/>
                <br/>
                <br/>
                <div class="row">
                    <div id="notif"></div>
                    <div class="col-md-6 col-md-offset-3">
                        <div class="well well-sm">
                            <form class="form-horizontal">
                                <fieldset>
                                    <legend class="text-center">Contact us</legend>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="name">Name</label>
                                        <div class="col-md-9">
                                            <input id="name" type="text" placeholder="Your name" class="form-control" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="email">E-mail</label>
                                        <div class="col-md-9">
                                            <input id="email" type="email" placeholder="Your email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="subject">Subject</label>
                                        <div class="col-md-9">
                                            <input id="subject" type="text" placeholder="Your subject" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="message">Your message</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 text-right">
                                            <button type="button" id="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <section about="scripts">
        <script type="text/javascript" src="js/app.js"></script>
        <script src="node_modules/socket.io-client/dist/socket.io.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>
    </section>
    </body>
</html>
