const container = document.getElementById('container1');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

const userNav = document.querySelector('.navi.user');
const adminNav = document.querySelector('.navi.admin');
const section1 = document.querySelector('.section1');
const section2 = document.querySelector('.section2');

// Set initial states
section1.style.transform = 'translateX(0)';
section2.style.transform = 'translateX(100vw)';
adminNav.classList.remove('active');
userNav.classList.add('active');

// Add click event listeners
userNav.addEventListener('click', () => {
    // Switch to Section 1
    section1.style.transform = 'translateX(0)';
    section2.style.left = '100vw';

    // Update active class
    userNav.classList.add('active');
    adminNav.classList.remove('active');
});

adminNav.addEventListener('click', () => {
    // Switch to Section 2
    section1.style.transform = 'translateX(-100vw)';
    section2.style.left = '-100vw';

    // Update active class
    adminNav.classList.add('active');
    userNav.classList.remove('active');
});




// Simpenan


        // var kurangBtn = document.querySelectorAll(".for.kurang");
        // kurangBtn.forEach(function(button) {
        //     button.addEventListener("click", function() {
        //         var productId = this.dataset.productId;
        //         var userId = this.dataset.userId;

        //         console.log(`Mengurangi item: ${productId} untuk user: ${userId}`);

        //         fetch('/kurangi-pro', {
        //                 method: 'POST',
        //                 headers: {
        //                     'Content-Type': 'application/json',
        //                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //                 },
        //                 body: JSON.stringify({
        //                     user_id: userId,
        //                     cart_id: productId
        //                 })
        //             })
        //             .then(response => response.json())
        //             .then(data => {
        //                 if (data.success) {
        //                     document.getElementById('cart-items').innerHTML = data.html;
        //                     document.getElementById('kurungs').innerHTML = data.xml;
        //                     document.getElementById('ss').innerHTML = data.ss;
        //                 } else {
        //                     alert('Gagal menambahkan item ke keranjang');
        //                 }
        //             })
        //             .catch(error => {
        //                 console.error('Error:', error);
        //                 alert('Terjadi kesalahan saat menambahkan item ke keranjang');
        //             });
        //     });
        // });


