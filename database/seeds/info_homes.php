<?php

use Illuminate\Database\Seeder;

class info_homes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('info_homes')->insert([
            'user_id' => 1,
            'titulo' => 'POR QUE ESCOLHER A POLICLÍNICA SAÚDE?',
            'descricao' => 'Todos os nossos profissionais são altamente qualificados, desde o atendimento inicial até os consultórios médicos.',
            'classe_css_1' => 'fa-book',
            'label_1' => 'MÉDICOS',
            'info_label_1' => 'Profissionais capacitados e comprometidos com a saúde e o bem estar dos nossos pacientes.',
            'classe_css_2' => 'fa-book',
            'label_2' => 'CURSOS',
            'info_label_2' => 'Oferecemos cursos e treinamentos completos e com foco no mercado de trabalho.',
            'classe_css_3' => 'fa-headphones',
            'label_3' => 'ATENDIMENTO',
            'info_label_3' => 'Fazemos do processo de atendimento uma atividade de excelência para nossos pacientes.',
            'classe_css_4' => 'fa-money-bill-alt',
            'label_4' => 'PRATICIDADE',
            'info_label_4' => 'Consulta e exames com alto padrão de qualidade e com preços acessíveis.'
        ]);
    }
}
