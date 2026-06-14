// API utility for AJAX calls
export default {
    async post(url, data = {}) {
        try {
            const response = await axios.post(url, data, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });
            return response.data;
        } catch (error) {
            throw error.response?.data || error;
        }
    },

    async get(url, params = {}) {
        try {
            const response = await axios.get(url, {
                params,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });
            return response.data;
        } catch (error) {
            throw error.response?.data || error;
        }
    },

    async put(url, data = {}) {
        try {
            const response = await axios.put(url, data, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });
            return response.data;
        } catch (error) {
            throw error.response?.data || error;
        }
    },

    async delete(url) {
        try {
            const response = await axios.delete(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });
            return response.data;
        } catch (error) {
            throw error.response?.data || error;
        }
    },
};
