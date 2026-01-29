UPDATE towers
SET status_sertifikat = 'belum'
WHERE status_sertifikat IS NULL;
