<?php
/**
 * Created by PhpStorm.
 * User: cedricleblond
 * Date: 23/12/17
 * Time: 10:34
 * 
 * doc :https://matthiasnoback.nl/2012/04/symfony2-setting-up-a-console-centered-application-with-composer/
 *      https://symfony.com/doc/3.4/components/console/helpers/questionhelper.html
 *      https://symfony.com/doc/3.4/console.html
 *      https://symfony.com/doc/3.4/console/input.html
 *      https://symfony.com/doc/3.4/console/style.html
 *
 *      http://symfony.com/doc/3.4/event_dispatcher.html
 *
 */

namespace SiteSupervisionBundle\Command;

use SiteSupervisionBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class AddUserCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('site_supervision:Create-user')
            ->setDescription('Création d\'un nouveau Role super admin')
            ->setDefinition(array(
                new InputArgument('email', InputArgument::REQUIRED, 'The email'),
                new InputArgument('password', InputArgument::REQUIRED, 'The password'),
                new InputArgument('role', InputArgument::REQUIRED,  'Insérer son role [ROLE_CUSTOMER, ROLE_USER_COMPANY_PRINCIPAL,ROLE_USER_COMPANY, ROLE_ADMIN, ROLE_SUPERADMIN] :')
            ))
            ->setHelp('Cette commande permet de créer un utilisateur')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        //create object user
        $user = new User();
        $user->setEmail($input->getArgument('email'));
        $user->setPassword($input->getArgument('password'));
        $user->setRoles($input->getArgument('role'));

        try{
            $manipulator = $this->getContainer()->get('Capvisu.ManagerUser');
            $manipulator->create($user);
            
            //message ok
            $style = new OutputFormatterStyle('white', 'green', array('bold'));
            $output->getFormatter()->setStyle('goodluck', $style);
            $output->writeln('<goodluck>The user account has been created :)</goodluck>');

        } catch (Exception $error){

            $style = new OutputFormatterStyle('white', 'Red', array('bold'));
            $output->getFormatter()->setStyle('goodluck', $style);
            $output->writeln('<goodluck>The user account has been created :)</goodluck>');
            throw $error;

        }
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        
        $questions = array();
        $output->writeln([
            'Création d\'un super admin',
            '==========================',
            '',
        ]);
        //email
        if (!$input->getArgument('email')) {
            $line = "<question>Please choose an email:</question> ";
            $question = new Question($line);
            //delete space
            $question->setNormalizer(function($email){
                return $email ? trim($email) : '';
            });
            
            $question->setValidator(function ($email) {
                if (empty($email)) {
                    throw new \Exception('Email can not be empty');
                }
                return $email;
            });
            $questions['email'] = $question;
        }
        
        //password
        if (!$input->getArgument('password')) {
            $line = "<question>Please choose a password :</question> ";
            $question = new Question($line);
            //delete space
            $question->setNormalizer(function($password){
                return $password ? trim($password) : '';
            });
            
            $question->setValidator(function ($password) {
                if (empty($password)) {
                    throw new \Exception('Password can not be empty');
                }
                return $password;
            });
            $question->setHidden(true);
            $question->setHiddenFallback(false);
            $questions['password'] = $question;
        }
        
        //role
        if (!$input->getArgument('role')) {
            $roleDefault = array('ROLE_SUPERADMIN', 'ROLE_ADMIN', 'ROLE_USER_COMPANY_PRINCIPAL', 'ROLE_CUSTOMER', 'ROLE_USER_COMPANY');
            $line = array(
                "<question>Please choose a role :</question> ",
                "<comment>Super Admin plateforme</comment>: ROLE_SUPERADMIN\n",
                "<comment>Admin de l entreprise principale</comment>: ROLE_ADMIN\n",
                "<comment>Utilisateur de l entreprise principale</comment>: ROLE_USER_COMPANY_PRINCIPAL\n",
                "<comment>Client de l entreprise</comment>: ROLE_CUSTOMER\n",
                "<comment>Utilisateur entreprise sous-traitant / partenaire</comment>: ROLE_USER_COMPANY\n",
            );
            
            $question = new Question($line);
            //Autocompleter
            $question->setAutocompleterValues($roleDefault);
            //delete space
            $question->setNormalizer(function($role){
                return $role ? trim($role) : '';
            });
            $question->setValidator(function ($role) {
                if (empty($role)) {
                    throw new \Exception('Role can not be empty');
                }
                return $role;
            });
            $questions['role'] = $question;
        }
        
        foreach ($questions as $name => $question) {
            $answer = $this->getHelper('question')->ask($input, $output, $question);
            $input->setArgument($name, $answer);
        }

    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output); // TODO: Change the autogenerated stub
    }


    /**
     * @return \Symfony\Component\DependencyInjection\ContainerInterface
     */
    public function getContainer()
    {
        return parent::getContainer(); // TODO: Change the autogenerated stub
    }


}