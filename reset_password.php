<?php
session_start();
if (!isset($_SESSION['code_verified'])) {
    header("Location: index.php");
    exit();
}
$pageTitle = "NDTBS - New Password";
include 'src/includes/header.php'; 
?>

<div class="min-h-screen w-full flex items-center justify-center bg-cover bg-center" style="background-image: url('public/assets/dolpen.jpg');">
    <div class="bg-white/10 backdrop-blur-lg border border-white/20 p-10 rounded-[3rem] shadow-2xl w-full max-w-md text-center">
        <h1 class="text-white text-2xl font-bold mb-8">New Password</h1>
        
        <form action="actions/reset_password_proc.php" method="POST" class="space-y-4">
            <input type="password" name="new_password" placeholder="NEW PASSWORD" required 
                   class="w-full px-6 py-3 rounded-full bg-white/90 text-gray-700 outline-none focus:ring-2 focus:ring-blue-400">
            
            <input type="password" name="confirm_password" placeholder="CONFIRM PASSWORD" required 
                   class="w-full px-6 py-3 rounded-full bg-white/90 text-gray-700 outline-none focus:ring-2 focus:ring-blue-400">
            
            <button type="submit" class="w-full bg-[#90FF7E] hover:bg-[#76E664] text-gray-900 font-bold py-3 rounded-full shadow-lg transition">
                UPDATE PASSWORD
            </button>
        </form>
    </div>
</div>

<?php include 'src/includes/footer.php'; ?>