// (function() {
//     const scriptTag = document.currentScript || document.querySelector('script[src*="chat-widget.js"]');
//     const scriptUrl = new URL(scriptTag.src);
//     const chatbotId = scriptUrl.searchParams.get('chatbot_id');
//     const token = scriptUrl.searchParams.get('token');
//     const baseUrl = scriptUrl.origin;

//     if (!chatbotId || !token) {
//         console.error('Chatbot ID and token are required');
//         return;
//     }

//     // --- 1. Create Main Container ---
//     const container = document.createElement('div');
//     Object.assign(container.style, {
//         position: 'fixed',
//         bottom: '20px',
//         right: '20px',
//         zIndex: '999999',
//         display: 'flex',
//         flexDirection: 'column',
//         alignItems: 'flex-end',
//         fontFamily: 'Arial, sans-serif'
//     });

//     // --- 2. Create the "Big" Window (Hidden by default) ---
//     const chatWindow = document.createElement('div');
//     Object.assign(chatWindow.style, {
//         width: '370px',
//         height: '550px',
//         maxHeight: '80vh',
//         maxWidth: '90vw',
//         backgroundColor: '#ffffff',
//         borderRadius: '15px',
//         boxShadow: '0 10px 25px rgba(0,0,0,0.15)',
//         marginBottom: '15px',
//         display: 'none', // Start hidden
//         overflow: 'hidden',
//         border: '1px solid #eee',
//         transition: 'all 0.3s ease'
//     });

//     const iframe = document.createElement('iframe');
//     iframe.src = `${baseUrl}/widget/load/${chatbotId}?token=${token}`;
//     Object.assign(iframe.style, {
//         width: '100%',
//         height: '100%',
//         border: 'none'
//     });
//     chatWindow.appendChild(iframe);

//     // --- 3. Create the "Small" Launcher (The Button) ---
//     const launcher = document.createElement('div');
//     Object.assign(launcher.style, {
//         width: '60px',
//         height: '60px',
//         backgroundColor: '#007bff', // Adjust color to your brand
//         borderRadius: '50%',
//         cursor: 'pointer',
//         boxShadow: '0 4px 12px rgba(0,0,0,0.2)',
//         display: 'flex',
//         alignItems: 'center',
//         justifyContent: 'center',
//         transition: 'transform 0.2s ease'
//     });

//     // Add a simple Message Icon (SVG)
//     launcher.innerHTML = `
//         <svg id="chat-icon-open" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
//         <svg id="chat-icon-close" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
//     `;

//     // --- 4. Logic to switch between Small and Big ---
//     let isChatOpen = false;

//     launcher.onclick = () => {
//         isChatOpen = !isChatOpen;
        
//         if (isChatOpen) {
//             chatWindow.style.display = 'block';
//             document.getElementById('chat-icon-open').style.display = 'none';
//             document.getElementById('chat-icon-close').style.display = 'block';
//             launcher.style.transform = 'rotate(90deg)';
//         } else {
//             chatWindow.style.display = 'none';
//             document.getElementById('chat-icon-open').style.display = 'block';
//             document.getElementById('chat-icon-close').style.display = 'none';
//             launcher.style.transform = 'rotate(0deg)';
//         }
//     };

//     // Hover effect
//     launcher.onmouseenter = () => launcher.style.transform = isChatOpen ? 'rotate(90deg) scale(1.1)' : 'scale(1.1)';
//     launcher.onmouseleave = () => launcher.style.transform = isChatOpen ? 'rotate(90deg) scale(1)' : 'scale(1)';

//     // --- 5. Append to Body ---
//     container.appendChild(chatWindow);
//     container.appendChild(launcher);
//     document.body.appendChild(container);
// })();




// chatbot_widgets.js
(function() {
    'use strict';
    
    const scriptTag = document.currentScript || document.querySelector('script[src*="chat-widget.js"]');
    if (!scriptTag) return console.error('Chat widget script tag not found');

    const scriptUrl = new URL(scriptTag.src);
    const chatbotId = scriptUrl.searchParams.get('chatbot_id');
    const token = scriptUrl.searchParams.get('token');
    const baseUrl = scriptUrl.origin;

    if (!chatbotId || !token) {
        console.error('Chatbot Widget: ID and token are required');
        return;
    }

    // Prevent double initialization
    if (window.__chatWidgetInitialized) return;
    window.__chatWidgetInitialized = true;

    // Create Shadow DOM for style isolation (optional but recommended)
    const host = document.createElement('div');
    host.id = 'chat-widget-host';
    document.body.appendChild(host);

    // Main container
    const container = document.createElement('div');
    Object.assign(container.style, {
        position: 'fixed',
        bottom: '0',
        right: '0',
        zIndex: '2147483647',
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'flex-end',
        fontFamily: 'system-ui, -apple-system, sans-serif',
        pointerEvents: 'none' // Allow clicks to pass through when closed
    });

    // Chat Window (Iframe)
    const chatWindow = document.createElement('div');
    Object.assign(chatWindow.style, {
        width: '380px',
        height: '600px',
        maxHeight: 'calc(100vh - 100px)',
        maxWidth: 'calc(100vw - 40px)',
        backgroundColor: '#ffffff',
        borderRadius: '20px',
        boxShadow: '0 25px 50px -12px rgba(0,0,0,0.25)',
        marginBottom: '20px',
        marginRight: '20px',
        display: 'none',
        overflow: 'hidden',
        border: '1px solid rgba(0,0,0,0.1)',
        transition: 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)',
        transform: 'scale(0.95) translateY(10px)',
        opacity: '0',
        pointerEvents: 'auto'
    });

    // Mobile styles
    const mobileStyles = document.createElement('style');
    mobileStyles.textContent = `
        @media (max-width: 480px) {
            #chat-widget-window {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width: 100vw !important;
                height: 100vh !important;
                height: 100dvh !important;
                max-width: none !important;
                max-height: none !important;
                margin: 0 !important;
                border-radius: 0 !important;
                z-index: 2147483647 !important;
            }
            #chat-widget-launcher {
                bottom: 20px !important;
                right: 20px !important;
            }
        }
    `;
    document.head.appendChild(mobileStyles);

    chatWindow.id = 'chat-widget-window';

    const iframe = document.createElement('iframe');
    iframe.src = `${baseUrl}/widget/load/${chatbotId}?token=${token}`;
    Object.assign(iframe.style, {
        width: '100%',
        height: '100%',
        border: 'none',
        display: 'block'
    });
    
    // Sandbox for security
    iframe.setAttribute('sandbox', 'allow-scripts allow-same-origin allow-forms allow-popups');
    iframe.setAttribute('loading', 'lazy');
    iframe.setAttribute('title', 'Chat Widget');
    
    chatWindow.appendChild(iframe);

    // Launcher Button
    const launcher = document.createElement('button');
    launcher.id = 'chat-widget-launcher';
    Object.assign(launcher.style, {
        width: '60px',
        height: '60px',
        background: 'linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%)',
        borderRadius: '50%',
        cursor: 'pointer',
        boxShadow: '0 10px 25px -5px rgba(79, 70, 229, 0.4)',
        border: 'none',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        transition: 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)',
        marginRight: '20px',
        marginBottom: '20px',
        pointerEvents: 'auto',
        position: 'relative'
    });

    // Notification badge
    const badge = document.createElement('span');
    Object.assign(badge.style, {
        position: 'absolute',
        top: '-2px',
        right: '-2px',
        width: '20px',
        height: '20px',
        background: '#ef4444',
        borderRadius: '50%',
        border: '3px solid white',
        display: 'none'
    });
    launcher.appendChild(badge);

    // Icons
    launcher.innerHTML += `
        <svg id="chat-icon-open" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.3s;">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
        </svg>
        <svg id="chat-icon-close" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none; transition: transform 0.3s;">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
    `;

    // State management
    let isChatOpen = false;
    let isMobile = window.matchMedia('(max-width: 480px)').matches;

    // Toggle function
    function toggleChat(forceState) {
        isChatOpen = forceState !== undefined ? forceState : !isChatOpen;
        const openIcon = launcher.querySelector('#chat-icon-open');
        const closeIcon = launcher.querySelector('#chat-icon-close');
        
        if (isChatOpen) {
            chatWindow.style.display = 'block';
            // Trigger reflow
            void chatWindow.offsetWidth;
            chatWindow.style.transform = isMobile ? 'none' : 'scale(1) translateY(0)';
            chatWindow.style.opacity = '1';
            
            openIcon.style.display = 'none';
            closeIcon.style.display = 'block';
            launcher.style.transform = 'rotate(90deg)';
            badge.style.display = 'none';
            
            // Focus iframe
            setTimeout(() => iframe.focus(), 100);
        } else {
            chatWindow.style.transform = isMobile ? 'none' : 'scale(0.95) translateY(10px)';
            chatWindow.style.opacity = '0';
            launcher.style.transform = 'rotate(0deg)';
            
            setTimeout(() => {
                if (!isChatOpen) chatWindow.style.display = 'none';
            }, 300);
            
            openIcon.style.display = 'block';
            closeIcon.style.display = 'none';
        }
    }

    // Event listeners
    launcher.addEventListener('click', () => toggleChat());
    
    launcher.addEventListener('mouseenter', () => {
        if (!isChatOpen) launcher.style.transform = 'scale(1.1)';
    });
    
    launcher.addEventListener('mouseleave', () => {
        launcher.style.transform = isChatOpen ? 'rotate(90deg)' : 'scale(1)';
    });

    // Listen for messages from iframe
    window.addEventListener('message', (e) => {
        if (e.data === 'closeChat') toggleChat(false);
        if (e.data === 'openChat') toggleChat(true);
        if (e.data === 'newMessage' && !isChatOpen) badge.style.display = 'block';
    });

    // Handle resize
    window.addEventListener('resize', () => {
        isMobile = window.matchMedia('(max-width: 480px)').matches;
        if (isChatOpen) {
            chatWindow.style.transform = isMobile ? 'none' : 'scale(1) translateY(0)';
        }
    });

    // Escape key to close
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isChatOpen) toggleChat(false);
    });

    // Click outside to close (desktop only)
    document.addEventListener('click', (e) => {
        if (isChatOpen && !isMobile && !container.contains(e.target)) {
            toggleChat(false);
        }
    });

    // Append to DOM
    container.appendChild(chatWindow);
    container.appendChild(launcher);
    host.appendChild(container);

    // Preload iframe on hover (performance optimization)
    let preloaded = false;
    launcher.addEventListener('mouseenter', () => {
        if (!preloaded && !isChatOpen) {
            iframe.src = iframe.src; // Refresh
            preloaded = true;
        }
    }, { once: true });

})();