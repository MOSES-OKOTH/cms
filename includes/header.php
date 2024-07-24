<?php
    // session_start();    
?>

<section class="header">
        
    <div class="logo">
        <a href='<?php if(isset($home)){ echo $home; }else{ echo "./"; } ?>'>
            <img src='<?php if(isset($logo)){ echo $logo; }else{ echo "./assets/logo1.png"; } ?>' alt="">
        </a>
    </div>

    <nav>
        <a href='<?php if(isset($home)){ echo $home; } else{ echo "./"; } ?>'>Home</a>
        <a href='<?php if(isset($complaint)){ echo $complaint; } else{ echo "./complaint"; } ?>'>File Complaint</a>
        <a href='<?php if(isset($follow)){ echo $follow; } else{ echo "./follow"; } ?>'>Follow Up</a>

        <?php if(!isset($_SESSION['userId'])): ?>
            <a href='<?php if(isset($login)){ echo $login; } else{ echo "./login.php"; } ?>' class='login'><i class='fa-regular fa-user'></i> &nbsp; Login</a>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['userId'])): ?>
                <a href='<?php if(isset($logout)){ echo $logout; } else{ echo "./logout.php"; } ?>' class='logout'><i class='fa-solid fa-sign-out'></i> &nbsp; Logout</a>
                <a href='<?php if(isset($notification)){ echo $notification; } else{ echo "./notification"; } ?>'><i class='fa-solid fa-bell'></i></a>
        <?php endif; ?>
    </nav>
</section>