import http from '@/api/http';

export default (id: number): Promise<void> => {
    return new Promise((resolve, reject) => {
        http.post(`/api/application/servers/${id}/reinstall`)
            .then(() => resolve())
            .catch(reject);
    });
};