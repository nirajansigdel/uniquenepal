<!-- Join Form Styles -->

<div class="registration-container">
    <div class="step-indicator">
        <div class="step active">1</div>
        <div class="step">2</div>
        <div class="step">3</div>
    </div>

    <!-- Step 1: Class Registration -->
    <div class="form-step active" data-step="1">
        <div class="section-title">
            <h2>Class Registration 🧘‍♂️</h2>
            <p class=" m-0 p-0">Begin your wellness journey with us. Choose your preferred class and schedule.</p>
        </div>

        <div class="form-group">
            <label for="main-category">Category</label>
            <select id="main-category" required>
                <option value="" disabled selected>Select Category</option>
                <option value="yoga">Yoga</option>
                <option value="meditation">Meditation</option>
                <option value="wellness">Wellness</option>
                <option value="learning">Learning</option>
                <option value="events">Events</option>
            </select>
        </div>

        <div class="form-group">
            <label for="sub-category">Subcategory</label>
            <select id="sub-category" required disabled>
                <option value="" disabled selected>Select category first</option>
            </select>
        </div>

        <div class="form-group">
            <label for="session-date">Date</label>
            <input type="date" id="session-date" required>
        </div>

        <div class="form-group">
            <label>Session Time</label>
            <div class="time-options">
                <div class="time-option">5-6 AM</div>
                <div class="time-option">6-7 AM</div>
                <div class="time-option">7-8 AM</div>
                <div class="time-option">5-6 PM</div>
                <div class="time-option">6-7 PM</div>
                <div class="time-option">7-8 PM</div>
            </div>
        </div>
        <div class="button-group">
            <button type="button" class="btn btn-continue" onclick="showStep(2)">Continue</button>
        </div>
    </div>

    <!-- Step 2: Personal Information -->
    <div class="form-step" data-step="2">
        <div class="section-title">
            <h2>Personal Information</h2>
            <p>Tell us a bit about yourself so we can better serve you.</p>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label for="full-name">Full Name</label>
            <input type="text" id="full-name" placeholder="Your full name" required>
        </div>
        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" id="country" placeholder="Your country" required>
        </div>
        <div class="button-group">
            <button type="button" class="btn btn-back" onclick="showStep(1)">Back</button>
            <button type="button" class="btn btn-continue" onclick="showStep(3)">Continue</button>
        </div>
    </div>

    <!-- Step 3: Payment -->
    <div class="form-step" data-step="3">
        <div class="section-title">
            <h2>Complete Registration</h2>
            <p>Secure your spot by completing the payment.</p>
        </div>
        <div class="form-group">
            <label for="card-number">Card Number</label>
            <input type="text" id="card-number" placeholder="4242 4242 4242 4242" required>
        </div>

        <div class="form-group">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div>
                    <label for="exp-date">Expiration</label>
                    <input type="text" id="exp-date" placeholder="MM/YY" required>
                </div>
                <div>
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" placeholder="123" required>
                </div>
            </div>
        </div>

        <div class="button-group">
            <button type="button" class="btn btn-back" onclick="showStep(2)">Back</button>
            <button type="button" class="btn btn-continue" onclick="submitForm()">Pay Now</button>
        </div>
    </div>

    <!-- Success Message -->
    <div class="success-message">
        <h2>🎉 Registration Successful!</h2>
        <p>Your class has been booked. We've sent a confirmation email.</p>
    </div>
</div>

<script>
const categoryData = {
    yoga: [
        "Basic Yoga",
        "Intermediate Yoga",
        "Advanced Yoga",
        "Pregnancy Yoga",
        "Back Pain Yoga",
        "Joint Pain Yoga",
        "Detox Yoga",
        "Chair Yoga"
    ],
    meditation: [
        "Depression Relief",
        "Anxiety Management",
        "Mental Wellness",
        "Breathing Techniques",
        "Mudras",
        "Concentration"
    ],
    wellness: [
        "Nutrition As Per Body Type",
        "Weight Management",
        "Diabetes Care",
        "Thyroid Management",
        "Blood Pressure Management",
        "Cholesterol Management",
        "Arthritis Care",
        "Fatty Liver Management"
    ],
    learning: [
        "Bhagvat Gita Class for Kids",
        "Public Speaking",
        "Slokas Recitation",
        "Srimat Bhagavat Mahapuran",
        "Book Club",
        "Nepali Language",
        "Sanskrit Language"
    ],
    events: [
        "Kids Online Book Club",
        "Adult Online Book Club",
        "Elderly Online Book Club",
        "Kids Online Slokas Recitation",
        "Kids Online Gita Reading"
    ]
};

let currentStep = 1;

function showStep(step) {
    if (step < 1 || step > 3) return;

    // Validate current step
    if (step > currentStep && !validateStep(currentStep)) return;

    // Update steps
    document.querySelector(`[data-step="${currentStep}"]`).classList.remove('active');
    currentStep = step;
    document.querySelector(`[data-step="${currentStep}"]`).classList.add('active');

    // Update step indicator
    document.querySelectorAll('.step').forEach((s, index) => {
        s.classList.toggle('active', index < currentStep);
    });
}

function validateStep(step) {
    if (step === 1) {
        const category = document.getElementById('main-category').value;
        if (!category) {
            alert('Please fill all required fields');
            return false;
        }
    }
    return true;
}

// Category/Subcategory handling
document.getElementById('main-category').addEventListener('change', function() {
    const sub = document.getElementById('sub-category');
    sub.disabled = false;
    sub.innerHTML = categoryData[this.value].map(opt =>
        `<option value="${opt.toLowerCase()}">${opt}</option>`
    ).join('');
});

// Time selection
document.querySelectorAll('.time-option').forEach(option => {
    option.addEventListener('click', function() {
        document.querySelectorAll('.time-option').forEach(opt =>
            opt.classList.remove('selected'));
        this.classList.add('selected');
    });
});

// Form submission
function submitForm() {
    document.querySelectorAll('.form-step').forEach(step => step.style.display = 'none');
    document.querySelector('.success-message').style.display = 'block';
    document.querySelectorAll('.step').forEach(step => step.classList.remove('active'));
}

// Set minimum date
document.getElementById('session-date').min = new Date().toISOString().split('T')[0];
</script>