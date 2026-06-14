// Validators utility
export default {
    validate(field, value) {
        const validators = {
            'nama_lengkap': this.validateName,
            'email': this.validateEmail,
            'email_confirmation': this.validateEmailConfirmation,
            'no_whatsapp': this.validateWhatsApp,
            'jenis_kelamin': this.validateGender,
            'provinsi': this.validateProvince,
            'tanggal_lahir': this.validateBirthDate,
        };

        if (validators[field]) {
            return validators[field].call(this, value);
        }

        return [];
    },

    validateName(value) {
        const errors = [];
        if (!value) errors.push('Nama lengkap wajib diisi');
        else if (value.length < 3) errors.push('Nama minimal 3 karakter');
        else if (value.length > 100) errors.push('Nama maksimal 100 karakter');
        else if (!/^[a-zA-Z\s\-\.\']+$/i.test(value)) errors.push('Nama hanya boleh mengandung huruf dan spasi');
        return errors;
    },

    validateEmail(value) {
        const errors = [];
        if (!value) errors.push('Email wajib diisi');
        else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) errors.push('Format email tidak valid');
        return errors;
    },

    validateEmailConfirmation(value) {
        const errors = [];
        if (!value) errors.push('Konfirmasi email wajib diisi');
        else {
            const emailInput = document.querySelector('input[name="email"]');
            if (emailInput && value !== emailInput.value) {
                errors.push('Email tidak cocok');
            }
        }
        return errors;
    },

    validateWhatsApp(value) {
        const errors = [];
        if (!value) errors.push('Nomor WhatsApp wajib diisi');
        else if (!/^(\+62|0)[0-9]{9,12}$/.test(value.replace(/\s/g, ''))) {
            errors.push('Format nomor WhatsApp tidak valid');
        }
        return errors;
    },

    validateGender(value) {
        const errors = [];
        if (!value) errors.push('Jenis kelamin wajib dipilih');
        else if (!['laki-laki', 'perempuan', 'other'].includes(value)) {
            errors.push('Jenis kelamin tidak valid');
        }
        return errors;
    },

    validateProvince(value) {
        const errors = [];
        if (!value) errors.push('Provinsi wajib dipilih');
        return errors;
    },

    validateBirthDate(value) {
        const errors = [];
        if (!value) {
            errors.push('Tanggal lahir wajib diisi');
        } else {
            const birthDate = new Date(value);
            const today = new Date();
            const age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            if (birthDate > today) errors.push('Tanggal lahir tidak boleh di masa depan');
            else if (age < 5) errors.push('Anda harus minimal 5 tahun');
        }
        return errors;
    }
};
