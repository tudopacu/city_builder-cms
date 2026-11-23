<?php

use yii\db\Migration;

/**
 * MySQL commits DDL implicitly, so a transaction cannot roll this back.
 * Every step checks the current schema instead, so a run that failed halfway can simply be re-run.
 */
class m261111_000100_add_age_id_to_buildings_items_road_types extends Migration
{
    const FIRST_AGE_ID = 1;

    const TABLES = [
        'buildings' => 'fk-buildings-age_id',
        'items' => 'fk-items-age_id',
        'road_types' => 'fk-road_types-age_id',
    ];

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        foreach (self::TABLES as $table => $fkName) {
            $schema = $this->db->getTableSchema($table, true);

            if ($schema->getColumn('age_id') === null) {
                // Add as nullable first so existing rows can be linked to the first age
                $this->addColumn("{{%$table}}", 'age_id', $this->integer()->after('id'));
            }

            $this->update("{{%$table}}", ['age_id' => self::FIRST_AGE_ID], ['age_id' => null]);
            $this->alterColumn("{{%$table}}", 'age_id', $this->integer()->notNull());

            if (!isset($schema->foreignKeys[$fkName])) {
                // RESTRICT on delete: an age in use cannot be removed without reassigning its content
                $this->addForeignKey(
                    $fkName,
                    "{{%$table}}",
                    'age_id',
                    '{{%ages}}',
                    'id',
                    'RESTRICT',
                    'CASCADE'
                );
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        foreach (self::TABLES as $table => $fkName) {
            $schema = $this->db->getTableSchema($table, true);

            if (isset($schema->foreignKeys[$fkName])) {
                $this->dropForeignKey($fkName, "{{%$table}}");
            }
            if ($schema->getColumn('age_id') !== null) {
                $this->dropColumn("{{%$table}}", 'age_id');
            }
        }
    }
}
