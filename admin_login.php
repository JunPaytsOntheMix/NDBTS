<?php
session_start();
// If already logged in as admin, go to dashboard directly
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    header("Location: admin_dashboard.php");
    exit();
}

$pageTitle = "NDTBS - Admin Portal";
include 'src/includes/header.php'; 
?>

<div class="min-h-screen bg-slate-900 flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl overflow-hidden p-10">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black text-slate-800 tracking-tighter">ADMIN <span class="text-blue-600">PANEL</span></h1>
            <p class="text-gray-400 text-sm mt-2">Authorized Personnel Only</p>
        </div>

        <form action="actions/admin_login_proc.php" method="POST" class="space-y-5">
            <div>
                <label class="text-xs font-bold text-gray-500 uppercase ml-1">Username</label>
                <input type="text" name="username" required 
                       class="w-full p-4 mt-1 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-400 transition">
            </div>
            <div>
                <label class="text-xs font-bold text-gray-500 uppercase ml-1">Password</label>
                <input type="password" name="password" required 
                       class="w-full p-4 mt-1 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-400 transition">
            </div>

            <?php if(isset($_GET['error'])): ?>
                <p class="text-red-500 text-xs font-bold text-center italic">
                    <?php 
                        if($_GET['error'] == 'restricted') echo "Please log in to access the admin area.";
                        else echo "Invalid administrative credentials.";
                    ?>
                </p>
            <?php endif; ?>

            <button type="submit" class="w-full bg-slate-800 text-white font-bold py-4 rounded-2xl hover:bg-slate-700 transition shadow-lg">
                SECURE LOGIN
            </button>
        </form>
        
        <div class="mt-8 text-center">
            <a href="index.php" class="text-gray-400 text-xs hover:text-blue-500 transition">← Back to Customer Site</a>
        </div>
    </div>
</div>