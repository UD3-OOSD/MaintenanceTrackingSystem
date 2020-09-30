<?php $this->setSiteTitle('user') ?>

<?php $this->start('head') ?>
<link rel="stylesheet" href="<?=PROOT?>css/regfo.css" media="screen" title="no title" charset="utf-8" >
<?php $this->end() ?>

<?php $this->start('body') ?>
<div class="container">
    <div class="form-head">
        <div class="col-sm-8 head-text"><h2>Employee <b> Registration </b></h2></div>
    </div>
    <form class="form-horizontal hr" method="post" action="">
        <div class="bg-danger"><?= $this->displayErrors ?></div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="fname">Full Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="fullName" id="xx" placeholder="In block capital letters" required value="<?=$this->post['fullName']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="lname">Last Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="lastName" id="xx" placeholder="In block capital letters" required value="<?=$this->post['lastName']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="name_init">Name with Initials</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="nameWIn" id="xx" placeholder="Ex:- A.B.C.Xyyyy" required value="<?=$this->post['nameWIn']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="address">Permanent Address</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="address" id="xx" required value="<?=$this->post['address']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="lname">Title</label>
            <div class="col-sm-4">
                <select clid="list" name="title" class="form-control">
                    <option value="<?=$this->post['title']?>" selected hidden><p><?=$this->post['title']?></p></option>
                    <option value="Mr.">Mr.</option>
                    <option value="Mrs.">Mrs.</option>
                    <option value="Ms.">Ms.</option>
                    <option value="Miss">Miss</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="nic">NIC Number</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="nic" id="xx" required value="<?=$this->post['nic']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="email">Email</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" name="email" id="xx" required placeholder="Ex:- sam1658@gmail.com" value="<?=$this->post['email']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="contact">Phone Number</label>
            <div class="col-sm-4">
                <input type="number" class="form-control" name="tel" id="xx" placeholder="0XX XXX XXXX" required value="<?=$this->post['tel']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="gender">Gender</label>
            <div class="col-sm-2" name = "gender">
                Male :<input type="radio" name="gender" id="gen" value="male">
            </div>
            <div class="col-sm-2">
                Female :<input type="radio" name="gender" id="gen" value="female">
            </div>
            <div class="col-sm-2">
                Other :<input type="radio" name="gender" id="gen" value="other" checked>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="race">Race</label>
            <div class="col-sm-4">
                <select clid="list" name="race" class="form-control">
                    <option value="<?=$this->post['race']?>" selected hidden><p><?=$this->post['race']?></p></option>
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
            <div class="col-sm-4">
                <select clid="list" name="acl" class="form-control">
                    <option value="<?=$this->post['acl']?>" selected hidden><p><?=$this->post['acl']?></p></option>
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
            <div class="col-sm-4">
                <select clid="list" name="religion" class="form-control">
                    <option value="<?=$this->post['religion']?>" selected hidden><p><?=$this->post['religion']?></p></option>
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
            <div class="col-sm-4">
                <input type="date" name="dob" class="form-control" required value="<?=$this->post['dob']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="img_path">Profile picture</label>
            <div class="col-sm-4">
                <input type="file" name="img_path" class="form-control" required value="<?=$this->post['img_path']?>">
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
            <div class="col-sm-offset-3 col-sm-3">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
            <div class="col-sm-offset col-sm-3">
                <a href=""><button type="button" class="btn btn-default">Refresh</button></a>
            </div>
        </div>
    </form>
</div>

<?php $this->end() ?>
