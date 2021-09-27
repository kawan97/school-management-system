
<?php
include './dbcon.php';

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?><nav class="bg-white shadow-lg">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between">
            <div class="flex space-x-7">
                <div>
                    <!-- Website Logo -->
                    <a href="#" class="flex items-center py-4 px-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
</svg>                        <span class="font-semibold text-green-500 text-lg"> School Managment System</span>
                    </a>
                </div>
                <!-- Primary Navbar items -->
                <div class="hidden md:flex items-center space-x-1">
                <a href="index.php" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Home </a>
                    <?php  
                    if(isset($_SESSION['role'])){
                        if($_SESSION['role'] == 'admin'){
                            $sql="select * from users where status=?;"; 
                            $stmt=$pdo->prepare($sql); 
                            $stmt->execute(array('deactivate'));   
                            $count=$stmt->rowCount();
                            echo '<a href="acceptuser.php" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">accept user('.$count.')</a>
                            ';
                        }
                    }
                    ?>
                     <?php  
                    if(isset($_SESSION['role']) && isset($_SESSION['id'])){
                        if($_SESSION['role'] == 'teacher'){
                            $sql="select * from class where teacherid=?;"; 
                            $stmt=$pdo->prepare($sql); 
                            $stmt->execute(array($_SESSION['id']));   
                            $count=$stmt->rowCount();
                            echo '<a href="myclass.php" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">My Class('.$count.')</a>
                            ';
                        }
                    }
                    ?>
                                         <?php  
                    if(isset($_SESSION['role']) && isset($_SESSION['id'])){
                        if($_SESSION['role'] == 'student'){
                            $sql="select * from enrollstu where studentname=? and status=?;"; 
                            $stmt=$pdo->prepare($sql); 
                            $stmt->execute(array($_SESSION['username'],'active'));   
                            $count=$stmt->rowCount();
                            echo '<a href="myclass.php" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">My Class('.$count.')</a>
                            ';
                        }
                    }
                    ?>
                    <?php  
                    if(isset($_SESSION['role']) && isset($_SESSION['id'])){
                        if($_SESSION['role'] == 'teacher'){
                            $sql="select enrollstu.id From enrollstu INNER JOIN
                            class ON enrollstu.classid=class.id WHERE enrollstu.status=? AND class.teachername=?;"; 
                            $stmt=$pdo->prepare($sql); 
                            $stmt->execute(array('deactivate',$_SESSION['username']));   
                            $count=$stmt->rowCount();
                            echo '<a href="acceptstudent.php" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">AcceptStudent('.$count.')</a>
                            ';
                        }
                    }
                    ?>

                                        <?php  
                    if(isset($_SESSION['role'])){
                        if($_SESSION['role'] == 'admin'){
                            $sql="select * from class where status=?;"; 
                            $stmt=$pdo->prepare($sql); 
                            $stmt->execute(array('deactivate'));   
                            $count=$stmt->rowCount();
                            echo '<a href="acceptclass.php" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">accept class('.$count.')</a>
                            ';
                        }
                    }
                    ?>

                    <?php
                    if(isset($_SESSION['role'])){
                        if($_SESSION['role'] == 'teacher'){
                            echo '                    <a href="addclass.php" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Add Class</a>
                            ';
                        }
                    }
                    ?>
                     <?php
                    if(isset($_SESSION['role'])){
                        if($_SESSION['role'] == 'student'){
                            echo '                    <a href="classes.php" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Classes</a>
                            ';
                        }
                    }
                    ?>

                    <a href="" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Contact Us</a>
                </div>
            </div>
            <!-- Secondary Navbar items -->
           
            <?php 
            if(!isset($_SESSION['username'])){
                echo ' <div class="hidden md:flex items-center space-x-3 ">
                <a href="login.php" class="py-2 px-2 font-medium text-gray-500 rounded hover:bg-green-500 hover:text-white transition duration-300">Log In</a>
                <a href="signup.php" class="py-2 px-2 font-medium text-white bg-green-500 rounded hover:bg-green-400 transition duration-300">Sign Up</a>
            </div>';
            }else{
                echo '<div class="hidden md:flex items-center space-x-3 ">
                <div class="py-2 px-2 font-medium text-gray-500 rounded hover:border-b-4 hover:border-green-500 hover:text-green-500 transition duration-300">type:'.$_SESSION['type'].'</div>
            ';
                echo '
                <a href="logout.php" class="py-2 px-2 font-medium text-white bg-green-500 rounded hover:bg-green-400 transition duration-300">LogOut</a>
            </div>';

            }
            
            ?>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button class="outline-none mobile-menu-button">
                <svg class=" w-6 h-6 text-gray-500 hover:text-green-500 "
                    x-show="!showMenu"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            </div>
        </div>
    </div>
    <!-- mobile menu -->
    <div class="hidden mobile-menu">
        <ul class="">
            <li class="active"><a href="index.html" class="block text-sm px-2 py-4 text-white bg-green-500 font-semibold">Home</a></li>
            <li><a href="#services" class="block text-sm px-2 py-4 hover:bg-green-500 transition duration-300">Services</a></li>
            <li><a href="#about" class="block text-sm px-2 py-4 hover:bg-green-500 transition duration-300">About</a></li>
            <li><a href="#contact" class="block text-sm px-2 py-4 hover:bg-green-500 transition duration-300">Contact Us</a></li>
        </ul>
    </div>
    <script>
        const btn = document.querySelector("button.mobile-menu-button");
        const menu = document.querySelector(".mobile-menu");

        btn.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });
    </script>
</nav>