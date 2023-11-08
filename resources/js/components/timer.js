const timer = {
    remainingTime: 600, // 10 минут в секундах
    formatTime: '10:00',

    startTimer() {
        setInterval(() => {
            this.updateTimer();
        }, 1000);
    },

    updateTimer() {
        if (this.remainingTime > 0) {
            const minutes = Math.floor(this.remainingTime / 60);
            const seconds = this.remainingTime % 60;
            this.formatTime = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            this.remainingTime--;
        }
    },
};

export default timer;
