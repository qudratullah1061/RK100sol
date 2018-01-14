<script src="<?php echo base_url('assets/custom_scripts/frontend/contactus.js'); ?>" type="text/javascript"></script>
<section class="wow fadeIn faq-header cover-background background-position-top top-space">
    <div class="opacity-medium bg-purple "></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
                <div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
                    <!-- start sub title -->
                    <!--<span class="display-block text-white opacity6 width-45 sm-width-100 center-col alt-font margin-10px-bottom">Frequently asked questions</span>-->
                    <!-- end sub title -->
                    <!-- start page title -->
                    <h1 class="alt-font text-white font-weight-500 no-margin-bottom">Contact Us</h1>
                    <!-- end page title -->
                </div>
            </div>
        </div>
    </div>
</section>
<section class="wow fadeIn parallax contact-us" data-stellar-background-ratio="0.5" style="background-image:url('<?php echo base_url('assets/frontend/img/konsorts-form-bg.jpg'); ?>');">
    <!--<div class="opacity-full bg-black"></div>-->
    <div class="container">
        <div class="row">
            <!-- start contact-form head -->
            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 center-col padding-30px-bottom sm-margin-40px-bottom xs-margin-30px-bottom text-center">
                <h5 class="alt-font text-white font-weight-500">We’d love To Hear From You!</h5>
                <div class="text-small text-white alt-font text-uppercase margin-5px-bottom margin-20px-bottom">If you have business inquiries or other questions, please fill out the following form to contact us. <br>  Thank you.</div>
            </div>
            <!-- end contact-form head -->
        </div>
        <!-- start contact-form -->
        <form id="form-add-contact" onsubmit="Contact.validation_to_contact();">
            <div class="row">
                <div class="col-md-12">
                    <div id="success-project-contact-form" class="no-margin-lr" style="display: none;"></div>
                </div>
                <div class="col-md-6">
                    <input type="text" name="name" id="name" placeholder="Full Name *" class="big-input">
                </div>
                <div class="col-md-6">
                    <input type="text" name="email" id="email" placeholder="E-mail *" class="big-input">
                </div>
                <div class="col-md-6">
                    <input type="text" name="phone" id="phone" placeholder="Phone *" class="big-input">
                </div>
                <div class="col-md-6">
                    <input type="text" name="subject" id="subject" placeholder="Enter your subject *" class="big-input">
                </div>

                <!--                <div class="col-md-6">
                                    <div class="select-style big-select">
                                        <select name="budget" id="budget" class="bg-transparent no-margin-bottom">
                                            <option value="">Select your budget</option>
                                            <option value="$500 - $1000">$500 - $1000</option>
                                            <option value="$1000 - $2000">$1000 - $2000</option>
                                            <option value="$2000 - $5000">$2000 - $5000</option>
                                        </select>
                                    </div>
                                </div>-->
                <div class="col-md-12">
                    <textarea name="comment" id="message" placeholder="Message for me *" rows="6" class="big-textarea"></textarea>
                </div>
                <div class="col-md-12 text-center">
                    <button id="project-contact-us-button" type="submit" class="btn btn-white btn-large margin-20px-top">send message</button>
                </div>
            </div>
        </form>
        <!-- end contact-form -->
    </div>
</section>



<script>
  $(document).ready(function () {
        Contact.validation_to_contact();
        
    });
</script>