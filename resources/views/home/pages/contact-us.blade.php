@extends('home.layouts.master')
@section('banner')
    <div class="row header-1-bg"></div>
@stop
@section('content')
    <div class="row">
        <div class="container content">
            <div class="row">
                <h2 style="color: #63ac1e; margin-top: 50px; margin-bottom: 0px;">Contact Us</h2>
                <div class="content col-md-12 text-left">

                    <div class="row">
                        <div class="text-center" style="padding: 20px 0px; margin-bottom: 30px;">We would love to hear. Please fill in the form below and we will get back to you shortly</div>
                        <div class="col-md-8">
                            <div class="well well-sm">
                                {!! Form::open(array('method' => 'post', 'class' => '', 'files'=> true)) !!}
                                @include('errors.messages')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">
                                                Name</label>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" required="required" />
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-envelope"></span>
                                                </span>
                                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Phone Number</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-phone"></span>
                                                </span>
                                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter phone number" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Message</label>
                                            <textarea name="messages" id="message" class="form-control" rows="9" cols="25" required="required" placeholder="Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">Send Message</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <form>
                                <legend><span class="glyphicon glyphicon-globe"></span> Our office</legend>
                                <address>
                                    <strong>Twitter, Inc.</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    <abbr title="Phone">
                                        P:</abbr>
                                    (123) 456-7890
                                </address>
                                <address>
                                    <strong>Full Name</strong><br>
                                    <a href="mailto:#">first.last@example.com</a>
                                </address>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <br>
            </div>
        </div>
    </div>
@stop