<?php
/**
 * App          : Pyramid PHP Fremework
 * Author       : Nihat Doğan
 * Email        : info@pyramid.com
 * Website      : https://www.pyramid.com
 * Created Date : 01/01/2025
 * License GPL
 *
 */

namespace Pyramid;

class Crypt {


    /**
     * @param $data
     * Şifreleme fonksiyonu
     *
     * @return mixed
     */
    public static function encrypt( $data ): mixed {
        return openssl_encrypt( json_encode( $data ), 'aes-256-cbc', Crypt::data()['key'], 0, Crypt::data()['iv'] );
    }


    /**
     * @param $data
     * Şifreyi çözme fonksiyonu
     *
     * @return mixed
     */
    public static function decrypt( $data ): mixed {
        /** Verinin null olup olmadığını kontrol et */
        if ( $data === null ) {
            /** Şifreli veri geçersiz, çözümleme yapma */
            return null;
        }
        $decrypted = openssl_decrypt( $data, 'aes-256-cbc', Crypt::data()['key'], 0, Crypt::data()['iv'] );

        /** Eğer çözme başarısızsa (false dönerse), null döndür */
        if ( $decrypted === false ) {
            return null;  // Çözme başarısız
        }

        /** JSON string'ine dönüştürülmüşse, tekrar nesneye dönüştür */
        return json_decode( $decrypted );
    }

    public static function data(): mixed {
        /** Şifreleme için anahtar (key) ve IV (Initialization Vector) kullanmalısınız */
        $data['key'] = 'pAYQzZ8xe4FGMbMs4RJpTJfU242e840z';
        /** Güçlü bir anahtar seçmelisiniz */
        $data['iv'] = env( 'APP_KEY', '7ba25a3ba05d0cc8' );

        /** IV'nin 16 byte olması gerekiyor */

        return $data;
    }

}