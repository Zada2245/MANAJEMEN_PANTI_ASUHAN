<div class="sidebar">
    <div class="sidebar-brand">
        CHARITY<span style="color:white;">HOPE</span>
    </div>
    
    <div class="sidebar-menu">
        <ul>
            <li>
                <a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                    <i class="fas fa-th-large"></i> Overview
                </a>
            </li>
            <li>
                <a href="data-donasi.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'data-donasi.php' ? 'active' : ''; ?>">
                    <i class="fas fa-hand-holding-usd"></i> Donations
                </a>
            </li>
            <li>
                <a href="input-berita.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'input-berita.php' ? 'active' : ''; ?>">
                    <i class="fas fa-newspaper"></i> News / Blog
                </a>
            </li>
            <li>
                <a href="data-relawan.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'data-relawan.php' ? 'active' : ''; ?>">
                    <i class="fas fa-users"></i> Volunteers
                </a>
            </li>
             <li>
                <a href="kelola-galeri.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'kelola-galeri.php' ? 'active' : ''; ?>">
                    <i class="fas fa-images"></i> Gallery
                </a>
            </li>
            
            <li style="margin-top: 50px;">
                <a href="#">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </li>
            <li>
                <a href="logout.php" onclick="return confirm('Yakin ingin keluar?')">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>

        </ul>
    </div>
</div>