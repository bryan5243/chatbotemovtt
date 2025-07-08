<style>
    /* Estilos del Chatbot EMOVTT */
    #emovtt-chatbot-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        font-family: Arial, sans-serif;
    }

    #chatbot-toggle {
        width: 60px;
        height: 60px;
        background: #2196F3;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }

    #chatbot-toggle:hover {
        transform: scale(1.1);
        animation: none;
    }

    #chatbot-window {
        width: 350px;
        height: 500px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        position: absolute;
        bottom: 70px;
        right: 0;
        display: none;
        flex-direction: column;
        overflow: hidden;
        animation: slideUp 0.3s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    #chatbot-header {
        background: linear-gradient(135deg, #2196F3, #1976D2);
        color: white;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .bot-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .bot-avatar {
        font-size: 24px;
        animation: bounce 1s ease-in-out infinite alternate;
    }

    @keyframes bounce {
        from {
            transform: translateY(0px);
        }

        to {
            transform: translateY(-3px);
        }
    }

    .bot-title {
        font-weight: bold;
        font-size: 14px;
    }

    .bot-status {
        font-size: 11px;
        opacity: 0.8;
    }

    #close-chat {
        background: none;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
        padding: 5px;
        border-radius: 50%;
        transition: background 0.3s ease;
    }

    #close-chat:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    #chatbot-messages {
        flex: 1;
        padding: 15px;
        overflow-y: auto;
        background: #fafafa;
    }

    .bot-message,
    .user-message {
        margin-bottom: 15px;
        animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .message-content {
        padding: 12px 15px;
        border-radius: 18px;
        font-size: 14px;
        line-height: 1.4;
        max-width: 85%;
        word-wrap: break-word;
    }

    .bot-message .message-content {
        background: white;
        border: 1px solid #e0e0e0;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .user-message {
        text-align: right;
    }

    .user-message .message-content {
        background: #2196F3;
        color: white;
        display: inline-block;
        margin-left: auto;
    }

    .quick-options {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-top: 15px;
    }

    .option-btn {
        background: white;
        border: 2px solid #2196F3;
        color: #2196F3;
        padding: 12px 15px;
        border-radius: 25px;
        cursor: pointer;
        font-size: 13px;
        transition: all 0.3s ease;
        text-align: left;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .option-btn:hover {
        background: #2196F3;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(33, 150, 243, 0.3);
    }

    #chatbot-input {
        padding: 15px;
        border-top: 1px solid #eee;
        background: white;
        display: flex;
        gap: 10px;
    }

    #user-input {
        flex: 1;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 25px;
        outline: none;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    #user-input:focus {
        border-color: #2196F3;
    }

    #send-btn {
        background: #2196F3;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 25px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    #send-btn:hover {
        background: #1976D2;
        transform: scale(1.05);
    }

    .typing-indicator {
        display: none;
        padding: 10px 15px;
        background: white;
        border-radius: 18px;
        margin-bottom: 15px;
        border: 1px solid #e0e0e0;
    }

    .typing-dots {
        display: flex;
        gap: 4px;
    }

    .typing-dots span {
        width: 8px;
        height: 8px;
        background: #999;
        border-radius: 50%;
        animation: typing 1.4s infinite ease-in-out;
    }

    .typing-dots span:nth-child(1) {
        animation-delay: -0.32s;
    }

    .typing-dots span:nth-child(2) {
        animation-delay: -0.16s;
    }

    @keyframes typing {

        0%,
        80%,
        100% {
            transform: scale(0.8);
            opacity: 0.5;
        }

        40% {
            transform: scale(1);
            opacity: 1;
        }
    }

    @media (max-width: 480px) {
        #chatbot-window {
            width: calc(100vw - 40px);
            height: calc(100vh - 100px);
            right: 20px;
            bottom: 80px;
        }
    }
</style>

<!-- Chatbot Container -->
<div id="emovtt-chatbot-container">
    <div id="chatbot-toggle" onclick="toggleChatbot()">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="white">
            <path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h4l4 4 4-4h4c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z" />
        </svg>
    </div>

    <div id="chatbot-window">
        <div id="chatbot-header">
            <div class="bot-info">
                <div class="bot-avatar">🚗</div>
                <div>
                    <div class="bot-title">Asistente EMOVTT</div>
                    <div class="bot-status">En línea</div>
                </div>
            </div>
            <button id="close-chat" onclick="toggleChatbot()">×</button>
        </div>

        <div id="chatbot-messages">
            <div class="bot-message">
                <div class="message-content">
                    👋 ¡Hola! Soy el asistente virtual de EMOVTT Santa Rosa.<br><br>
                    ¿En qué puedo ayudarte hoy?
                </div>
            </div>

            <div class="typing-indicator" id="typing-indicator">
                <div class="typing-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div class="quick-options" id="quick-options">
                <button class="option-btn" onclick="sendMessage('calendario')">
                    📅 Calendario de matriculación
                </button>
                <button class="option-btn" onclick="sendMessage('turno')">
                    🎫 Solicitar turno
                </button>
                <button class="option-btn" onclick="sendMessage('servicios')">
                    ⚙️ Servicios disponibles
                </button>
                <button class="option-btn" onclick="sendMessage('contacto')">
                    📞 Información de contacto
                </button>
                <button class="option-btn" onclick="sendMessage('noticias')">
                    📰 Noticias recientes
                </button>
            </div>
                <br></br>
        </div>

        <div id="chatbot-input">
            <input type="text" id="user-input" placeholder="Escribe tu pregunta..." onkeypress="handleKeyPress(event)">
            <button id="send-btn" onclick="sendUserMessage()">Enviar</button>
        </div>
    </div>
</div>

<script>
    let chatOpen = false;

    function toggleChatbot() {
        const window = document.getElementById('chatbot-window');
        const toggle = document.getElementById('chatbot-toggle');

        if (!chatOpen) {
            window.style.display = 'flex';
            toggle.style.display = 'none';
            chatOpen = true;
            document.getElementById('user-input').focus();
        } else {
            window.style.display = 'none';
            toggle.style.display = 'flex';
            chatOpen = false;
        }
    }

    function showTyping() {
        document.getElementById('typing-indicator').style.display = 'block';
        scrollToBottom();
    }

    function hideTyping() {
        document.getElementById('typing-indicator').style.display = 'none';
    }

    function sendMessage(type) {
        const responses = {
            'calendario': {
                text: '📅 <strong>Calendario de Matriculación</strong><br><br>Para consultar cuándo te corresponde matricular, dime el último dígito de tu placa.<br><br>Ejemplo: "Mi placa termina en 7" o simplemente "7"',
                showOptions: false
            },
            'turno': {
                text: '🎫 <strong>Solicitar Turno</strong><br><br>Para solicitar un turno, puedes:<br><br>📞 Llamar a:<br>• <strong>0993265241</strong><br>• <strong>0993206392</strong><br><br>🌐 O usar nuestra plataforma de <strong>Solicitud en Línea</strong>',
                showOptions: false
            },
            'servicios': {
                text: '⚙️ <strong>Nuestros Servicios</strong><br><br>• 🚗 Matriculación vehicular<br>• 🔧 Revisión técnica<br>• 📄 Emisión de documentos<br>• 💻 Consultas en línea<br>• 📋 Trámites administrativos',
                showOptions: false
            },
            'contacto': {
                text: '📞 <strong>Información de Contacto</strong><br><br>Teléfonos:<br>• <strong>0993265241</strong><br>• <strong>0993206392</strong><br><br>🌐 Sitio web: emovttsr.gob.ec<br><br>📍 Visita nuestra oficina o consulta la sección de Contactos en nuestra web.',
                showOptions: false
            },
            'noticias': {
                text: '📰 <strong>Noticias Recientes</strong><br><br>• 🚀 Lanzamiento de la aplicación Moovit en Santa Rosa<br>• 📋 Resoluciones del COE Cantonal<br>• 🔄 Reinicio de matriculación vehicular<br>• 🏛️ Convocatoria para centro de revisión técnica',
                showOptions: false
            }
        };

        addMessage(getOptionText(type), 'user');
        hideQuickOptions();

        showTyping();
        setTimeout(() => {
            hideTyping();
            addMessage(responses[type].text, 'bot');
            if (!responses[type].showOptions) {
                setTimeout(() => {
                    showQuickOptions();
                }, 1000);
            }
        }, 1500);
    }

    function getOptionText(type) {
        const options = {
            'calendario': '📅 Calendario de matriculación',
            'turno': '🎫 Solicitar turno',
            'servicios': '⚙️ Servicios disponibles',
            'contacto': '📞 Información de contacto',
            'noticias': '📰 Noticias recientes'
        };
        return options[type];
    }

    function sendUserMessage() {
        const input = document.getElementById('user-input');
        const message = input.value.trim();

        if (message) {
            addMessage(message, 'user');
            input.value = '';
            hideQuickOptions();

            showTyping();
            setTimeout(() => {
                hideTyping();
                let response = getSmartResponse(message.toLowerCase());
                addMessage(response, 'bot');
                setTimeout(() => {
                    showQuickOptions();
                }, 1000);
            }, 1500);
        }
    }

    function getNombreMes(numeroMes) {
        const meses = [
            "enero", "febrero", "marzo", "abril", "mayo", "junio",
            "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
        ];
        return meses[numeroMes];
    }

    function getMatriculaInfo(digito) {
        const calendario = [{
                mes: "enero",
                obligatorio: [],
                opcional: [1],
                multa: []
            },
            {
                mes: "febrero",
                obligatorio: [1],
                opcional: [2],
                multa: []
            },
            {
                mes: "marzo",
                obligatorio: [2],
                opcional: [3],
                multa: [1]
            },
            {
                mes: "abril",
                obligatorio: [3],
                opcional: [4],
                multa: [2]
            },
            {
                mes: "mayo",
                obligatorio: [4],
                opcional: [5],
                multa: [3]
            },
            {
                mes: "junio",
                obligatorio: [5],
                opcional: [6],
                multa: [4]
            },
            {
                mes: "julio",
                obligatorio: [6],
                opcional: [7],
                multa: [5]
            },
            {
                mes: "agosto",
                obligatorio: [7],
                opcional: [8],
                multa: [6]
            },
            {
                mes: "septiembre",
                obligatorio: [8],
                opcional: [9],
                multa: [7]
            },
            {
                mes: "octubre",
                obligatorio: [9],
                opcional: [0],
                multa: [8]
            },
            {
                mes: "noviembre",
                obligatorio: [0],
                opcional: [],
                multa: [9]
            },
            {
                mes: "diciembre",
                obligatorio: [],
                opcional: [],
                multa: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
            }
        ];

        const now = new Date();
        const mesActual = now.getMonth();
        const info = calendario[mesActual];
        const digitoNum = Number(digito);

        let respuesta = `📅 <strong>Calendario de Matriculación - ${info.mes.charAt(0).toUpperCase() + info.mes.slice(1)} 2025</strong><br><br>`;

        if (info.obligatorio.includes(digitoNum)) {
            respuesta += `✅ La matriculación es <strong>OBLIGATORIA</strong> para placas terminadas en <strong>${digito}</strong> este mes de <strong>${info.mes}</strong>.<br><br>`;
            respuesta += `⏰ <strong>¡No dejes pasar el tiempo!</strong><br>`;
            respuesta += `📞 Solicita tu turno: <strong>0993265241</strong> o <strong>0993206392</strong>`;

        } else if (info.opcional.includes(digitoNum)) {
            let mesObligatorio = -1;
            for (let i = 0; i < calendario.length; i++) {
                if (calendario[i].obligatorio.includes(digitoNum)) {
                    mesObligatorio = i;
                    break;
                }
            }

            respuesta += `🟡 Puedes matricularte de forma <strong>OPCIONAL</strong> este mes de <strong>${info.mes}</strong> si tu placa termina en <strong>${digito}</strong>.<br><br>`;

            if (mesObligatorio !== -1) {
                respuesta += `📋 <strong>Información importante:</strong><br>`;
                respuesta += `• Tu matriculación será <strong>OBLIGATORIA</strong> en <strong>${getNombreMes(mesObligatorio)}</strong><br>`;
                respuesta += `• Si no matriculas en ${getNombreMes(mesObligatorio)}, tendrás una <strong>multa de $50.00</strong><br><br>`;
            }

            respuesta += `📞 Para más información: <strong>0993265241</strong> o <strong>0993206392</strong>`;

        } else if (info.multa.includes(digitoNum)) {
            let mesObligatorioOriginal = -1;
            for (let i = 0; i < mesActual; i++) {
                if (calendario[i].obligatorio.includes(digitoNum)) {
                    mesObligatorioOriginal = i;
                    break;
                }
            }

            respuesta += `⚠️ Si tu placa termina en <strong>${digito}</strong>, puedes matricularte este mes de <strong>${info.mes}</strong> pero deberás pagar una <strong>MULTA</strong>.<br><br>`;

            if (mesObligatorioOriginal !== -1) {
                respuesta += `📋 <strong>Razón de la multa:</strong><br>`;
                respuesta += `• Tu matriculación era obligatoria en <strong>${getNombreMes(mesObligatorioOriginal)}</strong><br>`;
                respuesta += `• Al no matricular a tiempo, ahora aplica multa<br><br>`;
            }

            respuesta += `💰 <strong>Multa por matriculación tardía: $50.00</strong><br>`;
            respuesta += `📞 Contacto: <strong>0993265241</strong> o <strong>0993206392</strong>`;

        } else {
            let proximoMesObligatorio = -1;
            let proximoMesOpcional = -1;

            for (let i = mesActual + 1; i < calendario.length; i++) {
                if (calendario[i].obligatorio.includes(digitoNum)) {
                    proximoMesObligatorio = i;
                    break;
                }
                if (calendario[i].opcional.includes(digitoNum) && proximoMesOpcional === -1) {
                    proximoMesOpcional = i;
                }
            }

            if (proximoMesObligatorio === -1) {
                for (let i = 0; i < mesActual; i++) {
                    if (calendario[i].obligatorio.includes(digitoNum)) {
                        proximoMesObligatorio = i;
                        break;
                    }
                }
            }

            respuesta += `❌ Este mes de <strong>${info.mes}</strong> no corresponde la matriculación para placas terminadas en <strong>${digito}</strong>.<br><br>`;

            if (proximoMesOpcional !== -1) {
                respuesta += `📅 <strong>Tu calendario de matriculación:</strong><br>`;
                respuesta += `• <strong>Opcional:</strong> ${getNombreMes(proximoMesOpcional)}<br>`;
            }

            if (proximoMesObligatorio !== -1) {
                respuesta += `• <strong>Obligatorio:</strong> ${getNombreMes(proximoMesObligatorio)}<br>`;
                respuesta += `• <strong>Con multa:</strong> después de ${getNombreMes(proximoMesObligatorio)}<br><br>`;
            }

            respuesta += `📞 Para más información: <strong>0993265241</strong> o <strong>0993206392</strong>`;
        }

        return respuesta;
    }

    function getSmartResponse(message) {
        message = message.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();

        if (message.match(/^(hola|buenas|buenos dias|buenas tardes|buenas noches|saludos|hi|hello)/)) {
            return '¡Hola! 👋 ¿En qué puedo ayudarte hoy? Puedo ayudarte con información sobre matriculación, turnos y servicios. 😊';
        } else if (message.match(/(gracias|muchas gracias|te agradezco|thank you|thanks)/)) {
            return '¡De nada! 🙌 Si necesitas algo más, aquí estoy para ayudarte. ¿Hay algo más en lo que pueda asistirte?';
        } else if (message.match(/(quien eres|quien sos|quien es|eres un robot|eres humano|como te llamas)/)) {
            return '🤖 Soy el asistente virtual de EMOVTT Santa Rosa, creado para ayudarte con información y trámites de movilidad, tránsito y transporte.';
        } else if (message.match(/(que puedes hacer|que haces|para que sirves|ayuda|opciones|menu)/)) {
            return '🔧 Puedo ayudarte con:<br>• Calendario de matriculación<br>• Solicitar turnos<br>• Información de servicios<br>• Datos de contacto<br>• Noticias recientes<br><br>¿Sobre qué tema necesitas ayuda?';
        } else if (message.match(/(adios|chao|hasta luego|nos vemos|bye|goodbye)/)) {
            return '👋 ¡Hasta luego! Que tengas un excelente día. Recuerda que siempre puedes volver si necesitas ayuda con tus trámites vehiculares.';
        }

        const digitoMatch = message.match(/(?:placa.*?termina.*?en|termina.*?en|digito|dígito|numero|número|matricular.*?en|matriculacion.*?si.*?placa.*?en|mi.*?placa.*?termina.*?en|placa.*?en|placa.*?es|placa.*?finaliza.*?en)\s*([0-9])|^([0-9])$/);

        if (digitoMatch) {
            const digito = digitoMatch[1] || digitoMatch[2];
            return getMatriculaInfo(digito);
        }

        if (message.includes('matricul')) {
            return '🚗 Para información sobre matriculación, dime el último dígito de tu placa y te diré cuándo te corresponde matricular según el calendario oficial.<br><br>📞 También puedes llamar al <strong>0993265241</strong> o <strong>0993206392</strong>.';
        } else if (message.includes('turno') || message.includes('cita')) {
            return '🎫 Para solicitar un turno puedes:<br>📞 Llamar al <strong>0993265241</strong> o <strong>0993206392</strong><br>🌐 Usar nuestra plataforma de Solicitud en Línea';
        } else if (message.includes('horario') || message.includes('hora')) {
            return '🕐 Para conocer nuestros horarios de atención, te recomiendo llamar al <strong>0993265241</strong> o <strong>0993206392</strong>.';
        } else if (message.includes('precio') || message.includes('costo') || message.includes('valor') || message.includes('cuanto cuesta')) {
            return '💰 Para información sobre costos y tarifas de matriculación, contacta al <strong>0993265241</strong> o <strong>0993206392</strong>.';
        } else if (message.includes('documento') || message.includes('papel') || message.includes('requisito')) {
            return '📄 Para información sobre documentos requeridos para matriculación, llama al <strong>0993265241</strong> o <strong>0993206392</strong>.';
        } else if (message.includes('multa')) {
            return '⚠️ Las multas por matriculación tardía son de <strong>$50.00</strong>. Para más detalles, contacta al <strong>0993265241</strong> o <strong>0993206392</strong>.';
        } else {
            return '🤖 Gracias por tu consulta. Para obtener información más específica, puedes:<br>📞 Llamar al <strong>0993265241</strong> o <strong>0993206392</strong><br>🌐 Usar nuestros servicios en línea<br><br>¿Hay algo específico en lo que pueda ayudarte?';
        }
    }

    function addMessage(text, sender) {
        const messagesContainer = document.getElementById('chatbot-messages');
        const messageDiv = document.createElement('div');
        messageDiv.className = sender + '-message';
        messageDiv.innerHTML = '<div class="message-content">' + text + '</div>';
        messagesContainer.appendChild(messageDiv);
        scrollToBottom();
    }

    function hideQuickOptions() {
        const options = document.getElementById('quick-options');
        if (options) {
            options.style.display = 'none';
        }
    }

    function showQuickOptions() {
        const options = document.getElementById('quick-options');
        if (options) {
            options.style.display = 'flex';
        }
    }

    function scrollToBottom() {
        const messagesContainer = document.getElementById('chatbot-messages');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function handleKeyPress(event) {
        if (event.key === 'Enter') {
            sendUserMessage();
        }
    }

    setTimeout(() => {
        if (!chatOpen) {
            const toggle = document.getElementById('chatbot-toggle');
            toggle.style.animation = 'pulse 1s infinite';
        }
    }, 3000);
</script>