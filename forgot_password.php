<?php
$pageTitle = "NDTBS - Forgot Password";
include 'src/includes/header.php'; 
?>

<div class="min-h-screen w-full flex items-center justify-center bg-cover bg-center" style="background-image: url('public/assets/dolpen.jpg');">
    <div class="bg-white/10 backdrop-blur-lg border border-white/20 p-10 rounded-[3rem] shadow-2xl w-full max-w-md text-center">
        <h1 class="text-white text-2xl font-bold mb-4">Reset Password</h1>
        <p class="text-white/80 mb-8 text-sm uppercase">Enter your registered contact number</p>
        
        <form action="actions/forgot_password_proc.php" method="POST" class="space-y-4">
            <input type="text" name="contact" placeholder="CONTACT NO." required 
                   class="w-full px-6 py-3 rounded-full bg-white/90 text-gray-700 outline-none focus:ring-2 focus:ring-blue-400">
            
            <button type="submit" class="w-full bg-[#90FF7E] hover:bg-[#76E664] text-gray-900 font-bold py-3 rounded-full shadow-lg transition">
                SEND RESET CODE
            </button>
        </form>

        <?php if (isset($_GET['error']) && $_GET['error'] == 'notfound'): ?>
            <p class="text-red-400 mt-4 text-xs font-bold">Phone number not found!</p>
        <?php endif; ?>

        <div class="mt-6">
            <a href="index.php" class="text-white text-xs font-bold hover:underline uppercase">Back to Login</a>
        </div>
    </div>
</div>

<?php include 'src/includes/footer.php'; ?>