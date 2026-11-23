<?php

use yii\db\Migration;

class m261111_000000_ages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        // MySQL commits DDL implicitly: guard each step so a failed run can be re-run
        if ($this->db->getTableSchema('ages', true) === null) {
            $this->createTable('{{%ages}}', [
                'id' => $this->primaryKey(),
                'name' => $this->string()->notNull(),
                'period' => $this->string()->notNull(),
                'description' => $this->text(),
                'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->dateTime(),
            ]);
        }

        if ((new \yii\db\Query())->from('{{%ages}}')->exists($this->db)) {
            return;
        }

        $this->batchInsert('{{%ages}}', ['id', 'name', 'period', 'description'], [
            [1, 'Early Hominin Age', '7 million – 2.8 million BCE', 'Early human ancestors emerge in Africa; bipedalism develops.'],
            [2, 'Lower Paleolithic', '2.8 million – 300,000 BCE', 'First stone tools, early humans, hunting and controlled use of fire.'],
            [3, 'Middle Paleolithic', '300,000 – 50,000 BCE', 'Advanced stone tools, organized hunting and early symbolic behavior.'],
            [4, 'Upper Paleolithic', '50,000 – 10,000 BCE', 'Cave paintings, art, ornaments, advanced tools and human migration.'],
            [5, 'Mesolithic', '12,000 – 8,000 BCE', 'Post-Ice Age adaptation, fishing, hunting and gathering.'],
            [6, 'Neolithic', '10,000 – 4,500 BCE', 'Agriculture, animal domestication, permanent settlements and pottery.'],
            [7, 'Chalcolithic', '5,000 – 3,300 BCE', 'Copper metallurgy, early metalworking societies and social hierarchies.'],
            [8, 'Bronze Age', '3,300 – 1,200 BCE', 'Bronze tools, writing systems, cities, kingdoms and early empires.'],
            [9, 'Iron Age', '1,200 – 500 BCE', 'Iron tools and weapons, expanding kingdoms and large-scale trade.'],
            [10, 'Classical Antiquity', '500 BCE – 500 CE', 'Greek and Roman civilizations, philosophy, democracy, law and engineering.'],
            [11, 'Late Antiquity', '250 – 750 CE', 'Transformation of the Roman world, spread of major religions and rise of new empires.'],
            [12, 'Early Middle Ages', '500 – 1,000 CE', 'Post-Roman kingdoms, Byzantine expansion and development of feudal societies.'],
            [13, 'High Middle Ages', '1,000 – 1,300 CE', 'Growing cities, universities, castles, international trade and Gothic architecture.'],
            [14, 'Late Middle Ages', '1,300 – 1,500 CE', 'Plague, wars, social transformations and decline of medieval feudal structures.'],
            [15, 'Renaissance', '1,400 – 1,600 CE', 'Revival of classical knowledge, art, humanism, science and architecture.'],
            [16, 'Age of Exploration', '1,400 – 1,700 CE', 'Global maritime exploration, colonial expansion and interconnected trade networks.'],
            [17, 'Scientific Revolution', '1,500 – 1,700 CE', 'Modern scientific methods and breakthroughs in physics, astronomy and mathematics.'],
            [18, 'Enlightenment', '1,650 – 1,800 CE', 'Reason, individual rights, political philosophy and modern democratic ideas.'],
            [19, 'Industrial Age', '1760 – 1900 CE', 'Steam power, factories, mechanization, railways and mass production.'],
            [20, 'Electrical Age', '1870 – 1945 CE', 'Electricity, telecommunications, automobiles, aviation and modern industrial technology.'],
            [21, 'Atomic Age', '1945 – 1990 CE', 'Nuclear energy, nuclear weapons, computers and rapid scientific advancement.'],
            [22, 'Space Age', '1957 – Present', 'Satellites, space exploration, Moon landings and human activity beyond Earth.'],
            [23, 'Information Age', '1970 – Present', 'Computers, internet, digital communication and global information networks.'],
            [24, 'Biotechnology Age', '1970 – Present', 'Genetic engineering, genomics, biotechnology and advanced medicine.'],
            [25, 'Artificial Intelligence Age', '2010 – Present', 'Machine learning, intelligent automation, robotics and generative AI.'],
            [26, 'Intelligence Age', '2025 – 2100', 'AI becomes deeply integrated into civilization, science, industry and governance.'],
            [27, 'Biological Engineering Age', '2100 – 2200', 'Advanced genetic engineering, synthetic biology, regenerative medicine and artificial organs.'],
            [28, 'Planetary Civilization Age', '2200 – 2400', 'Planetary-scale infrastructure, fusion energy, climate engineering and ecosystem management.'],
            [29, 'Interplanetary Age', '2400 – 2800', 'Permanent settlements across the Solar System, asteroid mining and space industries.'],
            [30, 'Interstellar Civilization Age', '2800+', 'Interstellar exploration, potential settlements around other stars and advanced megastructures.'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        if ($this->db->getTableSchema('ages', true) !== null) {
            $this->dropTable('{{%ages}}');
        }
    }
}
