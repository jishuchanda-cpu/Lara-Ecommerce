class ChatApp {
    constructor() {
        this.currentConversationId = null;
        this.conversations = [];
        this.messages = {};
        this.isLoading = false;
        
        this.init();
    }
    
    init() {
        this.setupEventListeners();
        this.loadConversations();
    }
    
    setupEventListeners() {
        // New chat button
        document.getElementById('newChatBtn').addEventListener('click', () => {
            this.createNewConversation();
        });
        
        // Message form
        document.getElementById('messageForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.sendMessage();
        });
        
        // Delete conversation
        document.getElementById('deleteConversationBtn').addEventListener('click', () => {
            this.deleteCurrentConversation();
        });
        
        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (e.ctrlKey && e.key === 'Enter') {
                this.sendMessage();
            }
        });
    }
    
    showLoading(show = true) {
        const spinner = document.getElementById('loadingSpinner');
        if (show) {
            spinner.classList.remove('hidden');
        } else {
            spinner.classList.add('hidden');
        }
    }
    
    async loadConversations() {
        try {
            this.showLoading(true);
            const response = await fetch('/api/chat/conversations');
            const conversations = await response.json();
            
            this.conversations = conversations;
            this.renderConversations();
        } catch (error) {
            console.error('Error loading conversations:', error);
            this.showError('Failed to load conversations');
        } finally {
            this.showLoading(false);
        }
    }
    
    renderConversations() {
        const container = document.getElementById('conversationsList');
        
        if (this.conversations.length === 0) {
            container.innerHTML = `
                <div class="p-3 text-center text-gray-500 dark:text-gray-400 text-sm">
                    No conversations yet
                </div>
            `;
            return;
        }
        
        container.innerHTML = this.conversations.map(conv => `
            <div class="conversation-item p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer transition-colors ${this.currentConversationId === conv.id ? 'bg-gray-100 dark:bg-gray-700' : ''}"
                 data-id="${conv.id}">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white truncate">
                            ${conv.title}
                        </h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            ${conv.messages_count} messages
                        </p>
                    </div>
                    <button class="delete-conversation p-1 text-gray-400 hover:text-red-600 dark:hover:text-red-400 opacity-0 hover:opacity-100 transition-opacity"
                            data-id="${conv.id}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        `).join('');
        
        // Add click handlers
        container.querySelectorAll('.conversation-item').forEach(item => {
            item.addEventListener('click', (e) => {
                if (!e.target.closest('.delete-conversation')) {
                    this.selectConversation(parseInt(item.dataset.id));
                }
            });
        });
        
        container.querySelectorAll('.delete-conversation').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                this.deleteConversation(parseInt(btn.dataset.id));
            });
        });
    }
    
    async createNewConversation() {
        try {
            this.showLoading(true);
            const response = await fetch('/api/chat/conversations', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                },
                body: JSON.stringify({})
            });
            
            if (response.ok) {
                const conversation = await response.json();
                this.conversations.unshift(conversation);
                this.renderConversations();
                this.selectConversation(conversation.id);
            } else {
                throw new Error('Failed to create conversation');
            }
        } catch (error) {
            console.error('Error creating conversation:', error);
            this.showError('Failed to create conversation');
        } finally {
            this.showLoading(false);
        }
    }
    
    async selectConversation(conversationId) {
        if (this.isLoading) return;
        
        this.currentConversationId = conversationId;
        this.renderConversations();
        
        // Update UI
        document.getElementById('chatTitle').textContent = 
            this.conversations.find(c => c.id === conversationId)?.title || 'Unknown Chat';
        document.getElementById('deleteConversationBtn').classList.remove('hidden');
        document.getElementById('messageInput').disabled = false;
        document.getElementById('sendBtn').disabled = false;
        
        // Load messages
        await this.loadMessages(conversationId);
    }
    
    async loadMessages(conversationId) {
        try {
            this.isLoading = true;
            const response = await fetch(`/api/chat/conversations/${conversationId}/messages`);
            const messages = await response.json();
            
            this.messages[conversationId] = messages;
            this.renderMessages();
        } catch (error) {
            console.error('Error loading messages:', error);
            this.showError('Failed to load messages');
        } finally {
            this.isLoading = false;
        }
    }
    
    renderMessages() {
        const container = document.getElementById('messagesContainer');
        const messages = this.messages[this.currentConversationId] || [];
        
        if (messages.length === 0) {
            container.innerHTML = `
                <div class="flex items-center justify-center h-full text-gray-500 dark:text-gray-400">
                    <div class="text-center">
                        <p class="text-lg font-medium">Start the conversation</p>
                        <p class="text-sm mt-1">Send a message to begin chatting</p>
                    </div>
                </div>
            `;
            return;
        }
        
        container.innerHTML = messages.map(msg => `
            <div class="flex ${msg.role === 'user' ? 'justify-end' : 'justify-start'}">
                <div class="max-w-2xl ${msg.role === 'user' ? 'order-2' : 'order-1'}">
                    <div class="flex items-end gap-3 ${msg.role === 'user' ? 'flex-row-reverse' : ''}">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 ${
                            msg.role === 'user' 
                                ? 'bg-blue-600 text-white' 
                                : 'bg-gray-600 text-white'
                        }">
                            ${msg.role === 'user' ? 'U' : 'AI'}
                        </div>
                        <div class="rounded-lg px-4 py-2 ${
                            msg.role === 'user'
                                ? 'bg-blue-600 text-white'
                                : 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white'
                        }">
                            <p class="whitespace-pre-wrap">${this.escapeHtml(msg.content)}</p>
                            <p class="text-xs mt-1 ${msg.role === 'user' ? 'text-blue-100' : 'text-gray-500 dark:text-gray-400'}">
                                ${new Date(msg.created_at).toLocaleTimeString()}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');
        
        // Scroll to bottom
        container.scrollTop = container.scrollHeight;
    }
    
    async sendMessage() {
        const input = document.getElementById('messageInput');
        const message = input.value.trim();
        
        if (!message || this.isLoading || !this.currentConversationId) return;
        
        // Clear input
        input.value = '';
        
        // Add temporary user message
        const tempMessage = {
            role: 'user',
            content: message,
            created_at: new Date().toISOString()
        };
        
        if (!this.messages[this.currentConversationId]) {
            this.messages[this.currentConversationId] = [];
        }
        this.messages[this.currentConversationId].push(tempMessage);
        this.renderMessages();
        
        // Disable input during sending
        const sendBtn = document.getElementById('sendBtn');
        sendBtn.disabled = true;
        sendBtn.innerHTML = `
            <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div>
            Sending...
        `;
        
        try {
            const response = await fetch(`/api/chat/conversations/${this.currentConversationId}/messages`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                },
                body: JSON.stringify({ message })
            });
            
            if (response.ok) {
                const data = await response.json();
                
                // Replace temporary messages with actual ones
                this.messages[this.currentConversationId] = 
                    this.messages[this.currentConversationId].slice(0, -1);
                this.messages[this.currentConversationId].push(data.user_message);
                this.messages[this.currentConversationId].push(data.assistant_message);
                
                this.renderMessages();
                this.loadConversations(); // Refresh conversation list for updated message count
            } else {
                throw new Error('Failed to send message');
            }
        } catch (error) {
            console.error('Error sending message:', error);
            this.showError('Failed to send message');
            
            // Remove temporary message on error
            this.messages[this.currentConversationId] = 
                this.messages[this.currentConversationId].slice(0, -1);
            this.renderMessages();
        } finally {
            // Restore button state
            sendBtn.disabled = false;
            sendBtn.innerHTML = `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
                Send
            `;
        }
    }
    
    async deleteConversation(conversationId) {
        if (!confirm('Are you sure you want to delete this conversation?')) return;
        
        try {
            this.showLoading(true);
            const response = await fetch(`/api/chat/conversations/${conversationId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                }
            });
            
            if (response.ok) {
                this.conversations = this.conversations.filter(c => c.id !== conversationId);
                delete this.messages[conversationId];
                
                if (this.currentConversationId === conversationId) {
                    this.currentConversationId = null;
                    this.resetChatUI();
                }
                
                this.renderConversations();
            } else {
                throw new Error('Failed to delete conversation');
            }
        } catch (error) {
            console.error('Error deleting conversation:', error);
            this.showError('Failed to delete conversation');
        } finally {
            this.showLoading(false);
        }
    }
    
    async deleteCurrentConversation() {
        if (this.currentConversationId) {
            await this.deleteConversation(this.currentConversationId);
        }
    }
    
    resetChatUI() {
        document.getElementById('chatTitle').textContent = 'Select a conversation';
        document.getElementById('deleteConversationBtn').classList.add('hidden');
        document.getElementById('messageInput').disabled = true;
        document.getElementById('sendBtn').disabled = true;
        document.getElementById('messagesContainer').innerHTML = `
            <div class="flex items-center justify-center h-full text-gray-500 dark:text-gray-400">
                <div class="text-center">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-4l-4 4z"></path>
                    </svg>
                    <p class="text-lg font-medium">Start a conversation</p>
                    <p class="text-sm mt-1">Click "New Chat" to begin talking with AI</p>
                </div>
            </div>
        `;
    }
    
    showError(message) {
        // Simple error notification
        const errorDiv = document.createElement('div');
        errorDiv.className = 'fixed top-4 right-4 bg-red-600 text-white px-4 py-2 rounded-lg shadow-lg z-50';
        errorDiv.textContent = message;
        document.body.appendChild(errorDiv);
        
        setTimeout(() => {
            errorDiv.remove();
        }, 3000);
    }
    
    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
}

// Initialize the chat app when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new ChatApp();
});