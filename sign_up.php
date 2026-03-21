<?php
require_once 'vendor/autoload.php';

$pageTitle = "NDTBS - Create Account";
include 'src/includes/header.php'; 
?>

<div class="min-h-screen w-full flex items-center justify-center md:justify-end md:pr-20 bg-cover bg-center bg-no-repeat" 
     style="background-image: url('public/assets/dolpen.jpg');">
    
    <div class="bg-white/10 backdrop-blur-lg border border-white/20 p-8 rounded-[3rem] shadow-2xl w-full max-w-xl text-center my-10">
        
        <h1 class="text-white text-2xl font-bold mb-6 leading-tight drop-shadow-lg">
            Create Your Account
        </h1>

        <form action="actions/signup_proc.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <input type="text" name="fname" placeholder="FIRST NAME" required 
                   class="w-full px-5 py-2 rounded-full bg-white/90 text-gray-700 outline-none focus:ring-2 focus:ring-blue-400">
            
            <input type="text" name="mname" placeholder="MIDDLE NAME" 
                   class="w-full px-5 py-2 rounded-full bg-white/90 text-gray-700 outline-none focus:ring-2 focus:ring-blue-400">
            
            <input type="text" name="lname" placeholder="LAST NAME" required 
                   class="w-full px-5 py-2 rounded-full bg-white/90 text-gray-700 outline-none focus:ring-2 focus:ring-blue-400">
            
            <input type="text" name="username" placeholder="USERNAME" required 
                   class="w-full px-5 py-2 rounded-full bg-white/90 text-gray-700 outline-none focus:ring-2 focus:ring-blue-400">
            
            <input type="password" name="password" placeholder="PASSWORD" required 
                   class="w-full px-5 py-2 rounded-full bg-white/90 text-gray-700 outline-none focus:ring-2 focus:ring-blue-400 col-span-1 md:col-span-2">
            
            <input type="text" name="contact" placeholder="CONTACT NO." required 
                   class="w-full px-5 py-2 rounded-full bg-white/90 text-gray-700 outline-none focus:ring-2 focus:ring-blue-400">
            
            <input type="date" name="bdate" required 
                   class="w-full px-5 py-2 rounded-full bg-white/90 text-gray-700 outline-none focus:ring-2 focus:ring-blue-400">
            
            <input type="text" name="address" placeholder="ADDRESS" required 
                   class="w-full px-5 py-2 rounded-full bg-white/90 text-gray-700 outline-none focus:ring-2 focus:ring-blue-400 col-span-1 md:col-span-2">
            
            <select name="gender" required 
                    class="w-full px-5 py-2 rounded-full bg-white/90 text-gray-700 outline-none focus:ring-2 focus:ring-blue-400 col-span-1 md:col-span-2">
                <option value="" disabled selected>SELECT GENDER</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            
            <button type="submit" class="w-full bg-[#90FF7E] hover:bg-[#76E664] text-gray-900 font-bold py-3 rounded-full shadow-lg transition duration-300 col-span-1 md:col-span-2 uppercase">
                Register Account
            </button>
        </form>

        <div class="mt-6">
            <a href="index.php" class="text-white text-sm font-bold hover:underline uppercase">Already have an account? Log In</a>
        </div>
    </div>
</div>

<?php include 'src/includes/footer.php'; ?>