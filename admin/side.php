<section class="side">
    <nav>
        <p>Staff Portal</p>

        <a href=<?php if(isset($home)){ echo $home; } else{ echo "./"; } ?>><i class="fa-solid fa-home"></i><span>Dashboard</span></a>
        <a href=<?php if(isset($register)){ echo $register; } else{ echo "./register"; } ?>><i class="fa-solid fa-user-plus"></i><span>Register Students</span></a>
        <a href=<?php if(isset($complaints)){ echo $complaints; } else{ echo "./complaints"; } ?>><i class="fa-solid fa-message"></i><span>Manage Feedbacks</span></a>
        <a href=<?php if(isset($logout)){ echo $logout; } else{ echo "./logout.php"; } ?>><i class="fa-solid fa-sign-out"></i><span>Logout</span></a>
    </nav>
</section>