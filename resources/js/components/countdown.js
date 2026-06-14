// Countdown timer component for payment
export default function countdownComponent() {
    return {
        timeRemaining: 0,
        timerInterval: null,

        init(seconds) {
            this.timeRemaining = seconds;
            this.startTimer();
        },

        startTimer() {
            if (this.timerInterval) clearInterval(this.timerInterval);

            this.timerInterval = setInterval(() => {
                this.timeRemaining--;
                if (this.timeRemaining <= 0) {
                    this.onExpired();
                }
            }, 1000);
        },

        getFormattedTime() {
            const minutes = Math.floor(this.timeRemaining / 60);
            const seconds = this.timeRemaining % 60;
            return `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        },

        getProgressPercentage() {
            const totalSeconds = 600; // 10 minutes
            return Math.max(0, (this.timeRemaining / totalSeconds) * 100);
        },

        onExpired() {
            clearInterval(this.timerInterval);
            // This will be handled by the page logic
            window.dispatchEvent(new CustomEvent('payment-expired'));
        },

        destroy() {
            if (this.timerInterval) {
                clearInterval(this.timerInterval);
            }
        }
    };
}
