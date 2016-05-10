<p> User Profile Block </p>
<div class="userProfile">
    <form action="xxx" method="post" accept-charset="utf-8" class="xxx">
        <div>
            <label class="xxx" for="title" >User Name</label>
            <input class="xxx" type="text" id="title" name="title" value="<?php echo $user["title"];?>" 
                   autofocus tabindex="1" disabled>
        </div>
        <div>
            <label class="xxx" for="firstName" >First Name</label>
            <input class="xxx" type="text" id="firstName" name="firstName" value="<?php echo $user["firstName"];?>" 
                   autofocus tabindex="1" disabled>
        </div>
        <div>
            <label class="xxx" for="lastName" >Last Name</label>
            <input class="xxx" type="text" id="lastName" name="lastName" value="<?php echo $user["lastName"];?>" 
                   autofocus tabindex="1" disabled>
        </div>
        <div>
            <label class="xxx" for="email" >Email</label>
            <input class="xxx" type="text" id="email" name="email" value="<?php echo $user["email"];?>" 
                   autofocus tabindex="1" disabled>
        </div>
        <div>
            <label class="xxx" for="phoneHome" >Home Phone</label>
            <input class="xxx" type="text" id="phoneHome" name="phoneHome" value="<?php echo $user["phoneHome"];?>" 
                   autofocus tabindex="1" disabled>
        </div>
        <div>
            <label class="xxx" for="phoneMobile" >Mobile Phone</label>
            <input class="xxx" type="text" id="phoneMobile" name="phoneMobile" value="<?php echo $user["phoneMobile"];?>" 
                   autofocus tabindex="1" disabled>
        </div>
    </form>
    <form>
        <div>
            <label class="xxx" for="password" hidden>Password</label>
            <input class="xxx" type="password" id="password" name="password" value="<?php echo $user["password"];?>"
                   tabindex="2" hidden disabled>
        </div>
    </form>
</div>