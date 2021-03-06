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
                        <div class="text-center" style="padding: 20px 0px; margin-bottom: 30px;">We would love to hear from you.  Please fill in the form below and we will get back to you shortly.</div>
                        <div class="col-md-8">
                            <div class="well well-sm" style="background: #fff; border: 1px solid #ddd">
                                {!! Form::open(array('method' => 'post', 'class' => '', 'files'=> true)) !!}
                                @include('errors.messages')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">
                                                Name <span class="red">*</span></label>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" required="required" />
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email Address <span class="red"> *</span></label></label>
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
                                            <label for="name">Message<span class="red"> *</span></label></label>
                                            <textarea name="messages" id="message" class="form-control" rows="9" cols="25" required="required" placeholder="Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 submit">
                                        <button type="submit" class="btn btn-default pull-right" id="btnContactUs">Send Message</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <form>
                                <legend><span class="glyphicon glyphicon-globe"></span> Our office</legend>
                                <address>
                                    <strong>Court Connect</strong><br>
                                    135 Mayhew Dr<br>
                                    South Orange, NJ 07079, USA<br>
                                    <abbr title="Phone">
                                        Phone:</abbr>
                                    862-205-3858
                                </address>
                                <address>
                                    <strong>Support</strong><br>
                                    <a href="mailto:support@court-connect.com">support@court-connect.com</a>
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