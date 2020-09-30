<?php $this->setSiteTitle('Home'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=PROOT?>css/home_index.css" media="screen" title="no title" charset="utf-8" >
<link rel="stylesheet" href="<?=PROOT?>css/extra_css.css" media="screen" title="no title" charset="utf-8" >
<style>
    body {
        background-image: "<?=PROOT?>app/views/images/Front.jpg";
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }
</style>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="container-fluid">
        <div class="page_header">
            <div class="row align-items-start">
                <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                    <img id="sl-img" class="mx-auto d-block" width="90" src="sl.png">
                </div>
                <div id="sltb" class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="row text-center">
                        <div class="col"></div>
                        <h3>Sri Lanka Transport Board - Horana Depot</h3>
                        <div class="col"></div>
                    </div>
                    <div class="row text-center">
                        <div class="col"></div>
                        <h4>ශ්‍රී ලංකා ගමනාගමන මණ්ඩලය - හොරණ ඩිපෝව</h4>
                        <div class="col"></div>
                    </div>
                    <div class="row text-center">
                        <div class="col"></div>
                        <h5>இலங்கை போக்குவரத்து சபை - ஹொரானா டிப்போ</h5>
                        <div class="col"></div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                    <img id="sltb-img" class="mx-auto d-block" width="200" height="120" src="sltb.png">
                </div>
            </div>
        </div>
        <div class="page_body">
            <div class="row align-items-center text-center">
                <div class="col"></div>
                <div class="col welcome" style="margin-top: 6%; letter-spacing: 6px;">
                    <h1 class="animate__animated animate__zoomIn animate__delay-0.2s">Welcome!</h1>
                </div>
                <div class="col"></div>
            </div>
            <div class="row align-items-end justify-content-center">
                <div style="margin: 10px;">
                    <a id="btns" class="btn btn-outline-secondary animate__animated animate__bounceInLeft animate__delay-0.5s" href="">Log In</a>
                </div>
                <div style="margin: 10px;">
                    <a id="btns" class="btn btn-outline-secondary animate__animated animate__bounceInLeft animate__delay-0.5" href="">Sign Up</a>
                </div>
                <div style="margin: 10px;">
                    <a id="btns" class="btn btn-outline-secondary animate__animated animate__bounceInLeft animate__delay-0.5s" href="https://www.facebook.com/horana.depot">Visit us on fb</a>
                </div>
            </div>
        </section>
    </div>
<?php $this->end(); ?>

