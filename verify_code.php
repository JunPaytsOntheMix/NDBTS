<?php
session_start();
$pageTitle = "NDTBS - Verify Code";
include 'src/includes/header.php'; 
?>

<div class="min-h-screen w-full flex items-center justify-center bg-cover bg-center" style="background-image: url('public/assets/dolpen.jpg');">
    <div class="bg-white/10 backdrop-blur-lg border border-white/20 p-10 rounded-[3rem] shadow-2xl w-full max-w-md text-center">
        <h1 class="text-white text-2xl font-bold mb-4">Verification</h1>
        <p class="text-white/80 mb-8 text-sm">ENTER THE 6-DIGIT CODE SENT TO YOUR PHONE</p>
        
        <form action="actions/verify_code_proc.php" method="POST" class="space-y-4">
            <input type="text" name="user_code" maxlength="6" placeholder="000000" required 
                   class="w-full px-6 py-3 rounded-full bg-white text-center text-2xl tracking-[0.5em] font-bold outline-none focus:ring-2 focus:ring-blue-400">
            
            <button type="submit" class="w-full bg-[#90FF7E] hover:bg-[#76E664] text-gray-900 font-bold py-3 rounded-full shadow-lg transition">
                VERIFY CODE
            </button>
        </form>

        <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid'): ?>
            <p class="text-red-400 mt-4 text-xs font-bold">Invalid code! Try again.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'src/includes/footer.php'; ?>