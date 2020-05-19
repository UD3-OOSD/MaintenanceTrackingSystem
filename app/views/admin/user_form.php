<?php $this->setSiteTitle('user') ?>

<?php $this->start('head') ?>
<link rel="stylesheet" href="<?=PROOT?>css/regfo.css" media="screen" title="no title" charset="utf-8" >
<?php $this->end() ?>

<?php $this->start('body') ?>
<div class="container">
        <div class="row register">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 reg">
                <h1>Employee Registration Form</h1>
                <form class="form-horizontal hr" method="post" action=".php">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="fname">Full Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="xx" placeholder="In block capital letters" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="lname">Last Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="xx" placeholder="In block capital letters" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="name_init">Name with Initials</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="xx" placeholder="Ex:- A.B.C.Xyyyy" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="address">Permanent Address</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="xx" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="lname">Title</label>
                        <div class="col-sm-3">
                            <select clid="list" class="form-control">
                                <option value="1">Mr.</option>
                                <option value="2">Mrs.</option>
                                <option value="3">Ms.</option>
                                <option value="4">Miss</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="nic">NIC Number</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="xx" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="email">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="xx" placeholder="Ex:- sam1658@gmail.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="contact">Phone Number</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="xx" placeholder="+94XX XXX XXXX">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="gender">Gender</label>
                        <div class="col-sm-2">
                            Male : <input type="radio" id="gen">
                        </div>
                        <div class="col-sm-3">
                            Female : <input type="radio" id="gen">
                        </div>
                        <div class="col-sm-2">
                            Other : <input type="radio" id="gen">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="race">Race</label>
                        <div class="col-sm-3">
                            <select clid="list" class="form-control">
                                <option value="1">Sinhalese</option>
                                <option value="2">Tamil</option>
                                <option value="3">Muslim</option>
                                <option value="4">Burgher</option>
                                <option value="5">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="religion">Religion</label>
                        <div class="col-sm-3">
                            <select clid="list" class="form-control">
                                <option value="1">Buddhism</option>
                                <option value="2">Hinduism</option>
                                <option value="3">Christian</option>
                                <option value="4">Islam</option>
                                <option value="5">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="dob">Date of Birth</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember" required>I accept that this registration form is completed only by myself.</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-2">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                        <div class="col-sm-offset-1 col-sm-2">
                            <a href="EmployeeRegistrationForm.html"><button type="button" class="btn btn-default">Refresh</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $this->end() ?>
