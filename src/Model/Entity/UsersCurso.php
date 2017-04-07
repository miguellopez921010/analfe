<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UsersCurso Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $curso_id
 * @property \App\Model\Entity\Curso $curso
 * @property string $ciudad
 * @property \Cake\I18n\Time $fecha_diplomado
 * @property string $codigo_de_descarga
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class UsersCurso extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
