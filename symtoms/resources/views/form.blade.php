<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medico - Advanced Symptom Engine</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    
    <style>
        :root {
            --royal-blue: #0f2027;
            --accent-gold: #c5a059;
            --deep-black: #000000;
            --white: #f5f6fa;
            
            --bg-color: var(--royal-blue);
            --surface-color: rgba(15, 32, 39, 0.6);
            --accent-purple: var(--accent-gold);
            --accent-cyan: var(--accent-gold);
            --accent-danger: #ff4757;
            --text-main: var(--white);
            --text-muted: #a4b0be;
            --glass-border: rgba(197, 160, 89, 0.25);
        }

        body {
            background-color: var(--bg-color);
            background-image: 
                radial-gradient(at 5% 15%, rgba(197, 160, 89, 0.15) 0px, transparent 45%),
                radial-gradient(at 95% 85%, rgba(0, 0, 0, 0.6) 0px, transparent 45%);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            min-height: 100vh;
        }

        .navbar-custom {
            background: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid var(--glass-border);
        }

        #splash-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--royal-blue);
            z-index: 9999;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: opacity 5s ease;
        }
        .splash-logo {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--text-main), var(--accent-gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .splash-loader {
            width: 40px;
            height: 40px;
            border: 3px solid rgba(197, 160, 89, 0.1);
            border-radius: 50%;
            border-top-color: var(--accent-gold);
            animation: spin 2s linear infinite;
            margin-top: 20px;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        .glass-panel {
            background: var(--surface-color);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: 0 12px 40px 0 rgba(0, 0, 0, 0.6);
        }

        .header-title {
            font-size: 2.4rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--text-main) 40%, var(--accent-gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .chat-container {
            width: 100%;
            height: 320px;
            overflow-y: auto;
            padding: 15px;
            scroll-behavior: smooth;
        }

        .chat-message p {
            max-width: 80%;
            padding: 14px 20px;
            border-radius: 16px;
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 12px;
            display: inline-block;
        }

        .bot-message p {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            color: var(--text-main);
            border-top-left-radius: 2px;
        }

        .user-message {
            text-align: right;
        }

        .user-message p {
            background: linear-gradient(135deg, var(--accent-gold), #967439);
            color: var(--deep-black);
            font-weight: 500;
            border-top-right-radius: 2px;
        }

        .custom-input {
            background: rgba(255, 255, 255, 0.04) !important;
            border: 1px solid var(--glass-border) !important;
            color: var(--text-main) !important;
            border-radius: 14px 0 0 14px !important;
            padding: 16px 22px;
        }

        .custom-input:focus {
            border-color: var(--accent-gold) !important;
            box-shadow: 0 0 20px rgba(197, 160, 89, 0.25) !important;
        }

        .voice-btn {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid var(--glass-border);
            border-left: none;
            color: var(--text-muted);
            padding: 0 20px;
            font-size: 1.3rem;
            transition: all 0.2s;
        }

        .voice-btn:hover { color: var(--accent-gold); background: rgba(197, 160, 89, 0.08); }

        .action-btn {
            background: linear-gradient(135deg, var(--accent-gold), #967439);
            color: var(--deep-black);
            font-weight: 600;
            border: none;
            border-radius: 0 14px 14px 0;
            padding: 0 28px;
        }

        .medicine-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 22px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .medicine-card:hover {
            border-color: var(--accent-gold);
            transform: translateY(-4px);
        }

        /* Autocomplete UI style fixing */
        .ui-autocomplete {
            background: rgba(15, 32, 39, 0.95) !important;
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border) !important;
            border-radius: 12px;
            color: var(--white) !important;
        }
        .ui-menu-item-wrapper:hover, .ui-state-active {
            background: var(--accent-gold) !important;
            color: var(--deep-black) !important;
            border: none !important;
        }

        .text-info { color: var(--accent-gold) !important; }
        .btn-outline-info { color: var(--accent-gold) !important; border-color: var(--accent-gold) !important; }
        .btn-outline-info:hover { background-color: var(--accent-gold) !important; color: var(--deep-black) !important; }
        .btn-info { background-color: var(--accent-gold) !important; border-color: var(--accent-gold) !important; color: var(--deep-black) !important; }
        .bg-info { background-color: var(--accent-gold) !important; }
    </style>
</head>
<body>
@auth
<div id="splash-screen">
    <div class="splash-logo"><i class="bi bi-heart-pulse-fill text-info me-2"></i>Medico</div>
    <p class="text-muted small mt-2">Initializing Clinical Diagnostic Engine...</p>
    <div class="splash-loader"></div>
</div>
@endauth

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#" style="font-weight: 700; color: var(--text-main);">
            <i class="bi bi-heart-pulse-fill text-info me-2"></i> Medico
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center gap-3">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white bg-white bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center p-0 navbar-profile-toggle" 
                           href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                           style="width: 42px; height: 42px; border: 1px solid var(--accent-gold); transition: all 0.3s ease;">
                            <i class="bi bi-person-fill text-info fs-5"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2 p-3" aria-labelledby="profileDropdown"
                            style="background: rgba(15, 32, 39, 0.96); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px; min-width: 260px; box-shadow: 0 15px 35px rgba(0,0,0,0.6);">
                            <div class="text-center py-2 px-1 mb-2 border-bottom border-secondary border-opacity-25">
                                <div class="bg-info bg-opacity-10 text-info rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px; border: 1px dashed var(--accent-gold);">
                                    <i class="bi bi-person-badge-fill fs-4"></i>
                                </div>
                                <h6 class="text-white m-0 style="font-size: 1rem; letter-spacing: 0.3px;">{{ Auth::user()->name }}</h6>
                                <span class="text-muted d-block mt-1 text-truncate" style="font-size: 0.78rem;"><i class="bi bi-envelope me-1"></i>{{ Auth::user()->email }}</span>
                            </div>
                            <li class="my-1">
                                <a class="dropdown-item text-light rounded-3 py-2 small d-flex align-items-center gap-2 profile-menu-item" href="{{ route('profile.settings') }}">
                                    <i class="bi bi-sliders text-info"></i> Profile Settings
                                </a>
                            </li>
                            <li class="my-1">
                                <a class="dropdown-item text-light rounded-3 py-2 small d-flex align-items-center gap-2 profile-menu-item" href="{{ route('diagnostic.history') }}">
                                    <i class="bi bi-clock-history text-warning"></i> Diagnostic History
                                </a>
                            </li>
                            <hr class="border-secondary border-opacity-25 my-2">
                            <li class="mt-1">
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm w-100 rounded-pill py-2 d-flex align-items-center justify-content-center gap-2" style="font-weight: 500;">
                                        <i class="bi bi-box-arrow-right"></i> Logout Account
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-outline-info btn-sm rounded-pill px-4" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-info btn-sm rounded-pill px-4 text-dark" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                
                <div class="glass-panel p-4 mb-4">
                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom border-secondary border-opacity-25">
                        <div>
                            <h1 class="header-title m-0">Medico Diagnostics</h1>
                            <p class="text-muted small m-0">Type your symptoms or click the microphone to speak (e.g., cough, fever, headache)</p>
                        </div>
                    </div>

                    <div class="chat-container mb-4" id="chat-container">
                        <div class="chat-message bot-message">
                            <p>Assalam-o-Alaikum! <strong>{{ Auth::user()->name ?? 'Guest' }}</strong>. Apne symptoms niche box mein type karein ya mic icon daba kar bol kar batayein.</p>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" id="user-input" class="form-control custom-input" placeholder="Type or click microphone to speak symptoms...">
                       <button class="btn btn-secondary voice-btn" id="voice-button" type="button">
    <i class="bi bi-mic-fill"></i> Voice
</button>
                        <button class="btn action-btn btn-primary" id="send-button">Analyze</button>
                    </div>
                </div>

                <div class="glass-panel p-4" id="result-panel">
                    <h4 class="mb-4">Potential Treatment Protocols & Medications</h4>
                    <div id="medicine-display-target">
                        <p class="text-muted text-center py-4">Symptom check karne ke liye upar details submit karein.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // 1. Pehle variables ko initialize karein
    let symptomCheckerData = []; 
    let allSymptoms = []; // Yeh variable missing tha, ab crash nahi hoga

    // 2. Splash Screen Control
    $(window).on('load', function() {
        const splash = $('#splash-screen');
        if (splash.length) {
            setTimeout(function() {
                splash.css({
                    'opacity': '0',
                    'transition': 'opacity 0.5s ease'
                });
                setTimeout(function() {
                    splash.css('visibility', 'hidden');
                }, 500); 
            }, 500);
        }
    });
   
    // 3. JSON Data Fetching & Autocomplete Initialization
    document.addEventListener("DOMContentLoaded", function () {
        fetch("{{ asset('json/symptoms_data.json') }}")
            .then(response => {
                if (!response.ok) {
                    throw new Error("JSON file load nahi ho saki. Path check karein!");
                }
                return response.json();
            })
            .then(data => {
                // Agar data object hai aur usme objects ki array hai ya data khud array hai
                symptomCheckerData = Array.isArray(data) ? data : (data.symptoms_data || Object.values(data)); 
                
                console.log("Data loaded successfully! Total records:", symptomCheckerData.length);
                
                // Keywords se Autocomplete ki list bharna
                let symptomSet = new Set();
                symptomCheckerData.forEach(item => {
                    if (item.keywords && Array.isArray(item.keywords)) {
                        item.keywords.forEach(kw => symptomSet.add(kw));
                    }
                });
                allSymptoms = Array.from(symptomSet);

                enableAutocomplete();
            })
            .catch(error => {
                console.error("Error loading JSON:", error);
            });

        $('#send-button').on('click', function() {
            const inputVal = $('#user-input').val();
            
            if (inputVal.trim() !== "") {
            
                addMessageToChat(inputVal, true);
                
        
                setTimeout(function() {
                    const botReply = `I have analyzed your symptom '${inputVal}'. The full details regarding the possible illness, medications, and dietary restrictions have been rendered below in the 'Potential Treatment Protocols & Medications'`;
                    addMessageToChat(botReply, false);
                }, 300);
                
                checkConditionBySymptoms([inputVal]);

                $('#user-input').val(''); 
            }
        });
        });
    
    function enableAutocomplete() {
        const inputField = $("#user-input");
        if (inputField.length && $.fn.autocomplete) {
            inputField.autocomplete({
                source: allSymptoms, 
                minLength: 1
            });
        }
    }

    // Helper: Chat interface updates
    function addMessageToChat(text, isUser) {
        const chatContainer = $('#chat-container');
        if (chatContainer.length) {
            const messageClass = isUser ? 'user-message' : 'bot-message';
            const messageHtml = `
                <div class="chat-message ${messageClass} w-100">
                    <p>${text}</p>
                </div>`;
            chatContainer.append(messageHtml);
            chatContainer.scrollTop(chatContainer[0].scrollHeight);
        }
    }

// 5. Condition Analysis and UI Rendering
function checkConditionBySymptoms(userSymptomsArray) {
    const symptoms = userSymptomsArray.map(s => s.toLowerCase().trim());
    let matchedConditions = [];

    if (!symptomCheckerData || symptomCheckerData.length === 0) {
        console.error("symptomCheckerData is missing or empty!");
        $('#medicine-display-target').html('<p class="text-danger text-center">Error: Medical database not loaded.</p>');
        return matchedConditions;
    }

    symptomCheckerData.forEach(conditionData => {
        if (conditionData.keywords && Array.isArray(conditionData.keywords)) {
            const matchedSymptoms = conditionData.keywords.filter(keyword => {
                return symptoms.some(s => s.includes(keyword.toLowerCase().trim()));
            });

            if (matchedSymptoms.length >= 1) {
                const conditionsList = conditionData.conditions || [];
                
                conditionsList.forEach(condition => {
                    const isDuplicate = matchedConditions.some(item => item.condition === condition);
                    if (!isDuplicate) {
                        let currentMeds = [];
                        if (conditionData.medications) {
                            if (Array.isArray(conditionData.medications)) {
                                currentMeds = conditionData.medications;
                            } else if (typeof conditionData.medications === 'object') {
                                currentMeds = conditionData.medications[condition] || [];
                            }
                        }

                        let severityText = conditionData.severity_levels || 'N/A';
                        if (typeof severityText === 'object') {
                            severityText = Object.keys(severityText).join(', ');
                        }

                        let redFlagsText = 'N/A';
                        if (conditionData.red_flags && conditionData.red_flags.symptoms) {
                            redFlagsText = conditionData.red_flags.symptoms.join(', ');
                        } else if (conditionData.red_flags) {
                            redFlagsText = conditionData.red_flags;
                        }

                        matchedConditions.push({
                            condition: condition,
                            medications: currentMeds,
                            severity_levels: severityText,
                            duration: conditionData.duration || 'N/A',
                            red_flags: redFlagsText,
                            matchCount: matchedSymptoms.length // YE LINE ADD KI HAI
                        });
                    }
                });
            }
        }
    });

    // --- SORTING AUR LIMITING LOGIC (YE NAYA HAIN) ---
    // Sabse zyada match hone wali condition ko upar layein
    matchedConditions.sort((a, b) => b.matchCount - a.matchCount);
    // Sirf top 1 result uthayein
    const bestMatches = matchedConditions.slice(0, 1); 
    // --------------------------------------------------

    const targetDiv = $('#medicine-display-target');
    if (targetDiv.length) {
        targetDiv.empty(); 

        if (bestMatches.length > 0) {
            bestMatches.forEach(match => {
                let medsHtml = '';
                if (match.medications.length > 0) {
                    medsHtml = match.medications.map(m => {
                        if (typeof m === 'object' && m !== null) {
                            let name = m.name || 'Generic Protocol';
                            let desc = m.description || 'No description provided.';
                            return `
                                <li class="mb-3" style="list-style-type: none; border-left: 3px solid var(--accent-gold); padding-left: 12px;">
                                    <strong class="text-white d-block" style="font-size:1.05rem;"> ${name}</strong>
                                    <span class="text-white-50 d-block small mt-1">${desc}</span>
                                </li>`;
                        } else {
                            return `<li>${m}</li>`;
                        }
                    }).join('');
                } else {
                    medsHtml = `<li class="text-white-50">No specific medication listed.</li>`;
                }
$.ajax({
        url: '/save-diagnostic',
        type: 'POST',
        data: {
            keywords: userSymptomsArray.join(', '), // User ke symptoms string banakar
            condition_name: match.condition,
            severity_levels: match.severity_levels,
            _token: '{{ csrf_token() }}' // Blade file mein ye variable directly chal jayega
        },
        success: function(response) {
            console.log("History saved successfully!");
        },
        error: function(xhr) {
            console.log("Error:", xhr.responseText);
        }
    });
                // Is hisse ko apne existing targetDiv.append wale code mein replace karein:

targetDiv.append(`
    <div class="card bg-dark text-white mb-4 p-4" style="border: 1px solid var(--accent-gold); border-radius:16px; background: rgba(0,0,0,0.4) !important;">
        <h5 class="text-warning d-flex align-items-center gap-2">
            <i class="bi bi-exclamation-triangle-fill"></i> Possible Condition: ${match.condition}
        </h5>
        <hr class="border-secondary my-2">
        <div class="row row-cols-1 row-cols-md-3 g-2 my-2 py-2 rounded" style="background: rgba(255,255,255,0.02);">
            <div><strong>Severity Level:</strong> <span class="badge bg-danger text-uppercase px-2 py-1">${match.severity_levels}</span></div>
            <div><strong>Expected Duration:</strong> <span class="text-info">${match.duration}</span></div>
            <div><strong>Red Flags:</strong> <span class="text-danger fw-semibold">${match.red_flags}</span></div>
        </div>
        <h6 class="text-info mt-3 mb-3"><i class="bi bi-capsule"></i> Suggested Medications & Clinical Care:</h6>
        <ul class="ps-0">${medsHtml}</ul>
        
        <!-- Yahan humne disclaimer add kiya hai -->
        <div class="mt-4 pt-3" style="border-top: 1px solid rgba(255,255,255,0.1);">
            <p class="text-white-50 small mb-0 text-center">
                <i class="bi bi-info-circle"></i> Important: Please consult a doctor or healthcare professional before taking any medication.
            </p>
        </div>
    </div>
`);
            });
        } else {
            targetDiv.append(`<div class="text-center py-4 text-warning"><i class="bi bi-exclamation-triangle"></i> No matching clinical conditions found for your symptoms.</div>`);
        }
    }
    // Voice Button Handler
$('#voice-button').on('click', function () {

    // Browser support check
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

    if (!SpeechRecognition) {
        alert("Your browser does not support Speech Recognition.");
        return;
    }

    const recognition = new SpeechRecognition();

    // English + Roman Urdu
    recognition.lang = 'en-US';

    recognition.continuous = false;
    recognition.interimResults = false;
    recognition.maxAlternatives = 1;

    recognition.start();

    recognition.onstart = function () {
        $('#voice-button').html('<i class="bi bi-mic-fill"></i> Listening...');
    };

    recognition.onresult = function (event) {
        const transcript = event.results[0][0].transcript;

        // Input box mein speech show hogi
        $('#user-input').val(transcript);

        // Button normal ho jaye
        $('#voice-button').html('<i class="bi bi-mic-fill"></i> Voice');

        // Auto Analyze
        $('#send-button').click();
    };

    recognition.onerror = function (event) {
        $('#voice-button').html('<i class="bi bi-mic-fill"></i> Voice');

        alert("Error: " + event.error);
    };

    recognition.onend = function () {
        $('#voice-button').html('<i class="bi bi-mic-fill"></i> Voice');
    };

});
    
    return bestMatches;
}
</script>
</body>
</html>