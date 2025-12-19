<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<body>
    <header>
        <div class="left">
            <div class="logo">
                <img src="/UASPW/assets/images/canteen.png" alt="">
            </div>

            <div class="toggle-icon">
                <div class="icon" id="bar">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="icon hide" id="xmark">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>
        </div>

        <nav class="right" id="navbar">
            <ul>
                <li>
                    <a href="/UASPW/index.php"
                        class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>">
                        Home
                    </a>
                </li>

                <li>
                    <a href="/UASPW/pages/menu.php"
                        class="<?= ($currentPage == 'menu.php') ? 'active' : '' ?>">
                        Menu
                    </a>
                </li>

                <li>
                    <a href="/UASPW/pages/about.php"
                        class="<?= ($currentPage == 'about.php') ? 'active' : '' ?>">
                        About us
                    </a>
                </li>

                <li>
                    <a href="/UASPW/pages/contact.php"
                        class="<?= ($currentPage == 'contact.php') ? 'active' : '' ?>">
                        Contact
                    </a>
                </li>

                <li>
                    <a href="/UASPW/pages/order.php"
                        class="org-btn <?= ($currentPage == 'order.php') ? 'active' : '' ?>">
                        Order Now
                    </a>
                </li>
            </ul>
        </nav>
    </header>