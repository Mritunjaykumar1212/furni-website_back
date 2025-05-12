<!-- resources/views/components/login-modal.blade.php -->
<div id="loginModal" style="display: none;">
    <div class="bg-black/60 fixed inset-0 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded shadow w-80">
            <h2 class="text-xl font-bold mb-4">Login</h2>
            <input type="text" id="email" placeholder="Enter Email" class="border p-2 w-full mb-2">
            <button onclick="sendOtp()" class="bg-blue-600 text-white px-4 py-2 w-full">Send OTP</button>
            <div id="otpSection" style="display:none;" class="mt-4">
                <input type="text" id="otp" placeholder="Enter OTP" class="border p-2 w-full mb-2">
                <button onclick="verifyOtp()" class="bg-green-600 text-white px-4 py-2 w-full">Verify OTP</button>
            </div>
        </div>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('loginModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('loginModal').style.display = 'none';
}

function sendOtp() {
    let email = document.getElementById('email').value;
    fetch('/send-otp', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ email: email })
    }).then(res => res.json())
      .then(data => {
          if(data.success){
              alert("OTP Sent");
              document.getElementById('otpSection').style.display = 'block';
          }
      });
}

function verifyOtp() {
    let email = document.getElementById('email').value;
    let otp = document.getElementById('otp').value;
    fetch('/verify-otp', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ email: email, otp: otp })
    }).then(res => res.json())
      .then(data => {
          if(data.success){
              alert("Login Success");
              closeModal();
              location.reload(); // Optional
          } else {
              alert("Invalid OTP");
          }
      });
}
</script>
