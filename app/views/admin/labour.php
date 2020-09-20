<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=PROOT?>css/regfo.css" media="screen" title="no title" charset="utf-8" >

<?php $this->end(); ?>
<?php $this->start('body') ?>
<?php $name =  $this->post['fullName']?>
<div class="container">
        <div class="row register">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 reg">
                <div class="form-head">
                    <div class="col-sm-8 head-text"><h2>edit <b> Labour </b></h2></div>
                </div>
                <form class="form-horizontal hr" method="post" action="saveLabour" >
                    <div class="dg-danger"><?= $this->displayErrors ?></div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="fname">Full Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="fullName" id="xx" placeholder="In block capital letters" required value="<?=$this->post['fullName']?>" locked>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="lname">Last Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="lastName" id="xx" placeholder="In block capital letters" required value="<?=$this->post['lastName']?>" locked>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="name_init">Name with Initials</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nameWIn" id="xx" placeholder="Ex:- A.B.C.Xyyyy" required value="<?=$this->post['nameWIn']?>" locked>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="address">Permanent Address</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="address" id="xx" required value="<?=$this->post['address']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="lname">Title</label>
                        <div class="col-sm-6">
                            <select clid="list" name="title" class="form-control">
                                <option value="Mr.">Mr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Ms.">Ms.</option>
                                <option value="Miss">Miss</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="nic">NIC Number</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nic" id="xx" required value="<?=$this->post['nic']?>" locked>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="contact">Phone Number</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" name="tel" id="xx" placeholder="0XX XXX XXXX" required value="<?=$this->post['tel']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="gender">Gender</label>
                        <div class="col-sm-3" name = "gender">
                            Male: <input type="radio" name="gender" id="gen" value="male">
                        </div>
                        <div class="col-sm-3">
                            Female: <input type="radio" name="gender" id="gen" value="female">
                        </div>
                        <div class="col-sm-3">
                            Other: <input type="radio" name="gender" id="gen" value="other" checked>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="race">Race</label>
                        <div class="col-sm-6">
                            <select clid="list" name="race" class="form-control" autofocus="<? $this->post['race']?>" >
                                <option value="Sinhalese">Sinhalese</option>
                                <option value="Tamil">Tamil</option>
                                <option value="Muslim">Muslim</option>
                                <option value="Burgher">Burgher</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="rank">Rank</label>
                        <div class="col-sm-6">
                            <select clid="list" name="acl" class="form-control" autofocus="<? $this->post['acl']?>">
                                <option value="Admin">Admin</option>
                                <option value="Forman">Forman</option>
                                <option value="Mechanics">Mechanics</option>
                                <option value="Clerk">Clerk</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="religion">Religion</label>
                        <div class="col-sm-6">
                            <select clid="list" name="religion" class="form-control" autofocus="<? $this->post['religion']?>">
                                <option value="Buddhism">Buddhism</option>
                                <option value="Hinduism">Hinduism</option>
                                <option value="Christian">Christian</option>
                                <option value="Islam">Islam</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="dob">Date of Birth</label>
                        <div class="col-sm-6">
                            <input type="date" name="dob" class="form-control" required value="<?=$this->post['dob']?>">
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
                            <button type="submit" class="btn btn-default" name="save" value="save">SAVE</button>
                        </div>
                        <div class="col-sm-offset-1 col-sm-2">
                            <button type="submit" class="btn btn-default" name="delete" value="delete">DELETE</button></a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
<?php $this->end() ?>
