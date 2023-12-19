<?php

/**
 * Created by PhpStorm.
 * User: abramotesoro
 * Date: 01/02/2022
 * Time: 12:21
 */

namespace Aip\Bit3\Controller;
use Doctrine\DBAL\DBALException;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Aip\Bit3\Domain\Repository\AbstractRepository;
use TYPO3\CMS\Extbase\Configuration\BackendConfigurationManager;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Backend\Attribute\Controller;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;


class ModuleConfController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
	public function __construct(
		protected readonly ModuleTemplateFactory $moduleTemplateFactory
     ) {
     }

    /**
     * @var
     */
    protected $templateUid;

	/**
	 * @var \Aip\Bit3\Domain\Repository\AbstractRepository
	 *
	 */
	protected $abstractRepository = NULL;

    /**
     * @param AbstractRepository $abstractRepository
     * @return void
     */
    public function injectAbstractRepository(AbstractRepository $abstractRepository)
    {
        $this->abstractRepository = $abstractRepository;
    }

    /**
     * @var \Aip\Bit3\Domain\Repository\AbstractRepository
     *
     */
    protected $backendConfigurationManager = NULL;

    /**
     * @param BackendConfigurationManager $backendConfigurationManager
     * @return void
     */
    public function injectBackendConfigurationManager(BackendConfigurationManager $backendConfigurationManager)
    {
        $this->backendConfigurationManager = $backendConfigurationManager;
    }

    /**
     * @var int
     *
     */
    protected $pageId=-1;

    /**
     * @return void
     * @throws DBALException
     */
    protected function initializeAction() {

        $pageId=(int)GeneralUtility::_GP('id');

        if(!$pageId){
             throw new \Exception("Nessun template typoscript trovato, non è possibile configurare il sito, selezionare nell'albero pagine a sinistra la root page del sito che si vuole configurare.");
        }

        $this->setSysTemplateUid($pageId);

    }

    /**
     * @return void
     */
    public function indexAction(): ResponseInterface {
		$this->view->assign('action', 'index');
		$moduleTemplate = $this->moduleTemplateFactory->create($this->request);
		// Adding title, menus, buttons, etc. using $moduleTemplate ...
		$moduleTemplate->setContent($this->view->render());
		return $this->htmlResponse($moduleTemplate->renderContent());
	}



    /**
     * @return void
     */
    public function skinAction(): ResponseInterface {
		$this->view->assign('action', 'skin');

		$vettSkinConf = $this->abstractRepository->findConstantsSysTemplate($this->templateUid);

		$vettSkinConf = $this->populateForm('header', $vettSkinConf);
		$vettSkinConf = $this->populateForm('skin', $vettSkinConf);

		$this->view->assign('vettSkinConf',$vettSkinConf);

		$moduleTemplate = $this->moduleTemplateFactory->create($this->request);
		// Adding title, menus, buttons, etc. using $moduleTemplate ...
		$moduleTemplate->setContent($this->view->render());
		return $this->htmlResponse($moduleTemplate->renderContent());
    }

	/**
	 * salva i parametri inseriti o modificati nella Pagina di configurazione Logo e Colori
	 *
	 * @return void
	 */
	public function salvaSkinAction(): ResponseInterface {
		$constantNames= array(
			'header.nome_ente_appartenenza',
			'skin.path_logo_ente_appartenenza',
			'header.link_ente_appartenenza',
			'header.nome_istituzione',
			'skin.path_logo',
			'header.secondary_navigation');

		$this->updateContstants($constantNames);

		$colorConstantNames= array(
			'skin.primary_color');

		$this->updateColorContstants($colorConstantNames);

		return $this->redirect('skin');
	}

    /**
     * visualizza la form della pagina di configurazione Contatti Copyrights & Credits
     *
     * @return void
     */
    public function contattiAction(): ResponseInterface {
		$this->view->assign('action', 'contatti');

		$vettContattiConf = $this->abstractRepository->findConstantsSysTemplate($this->templateUid);

        $vettContattiConf = $this->populateForm('contacts', $vettContattiConf);
        $vettContattiConf = $this->populateForm('copyrights', $vettContattiConf);

        $this->view->assign('vettContattiConf',$vettContattiConf);

		$moduleTemplate = $this->moduleTemplateFactory->create($this->request);
		// Adding title, menus, buttons, etc. using $moduleTemplate ...
		$moduleTemplate->setContent($this->view->render());
		return $this->htmlResponse($moduleTemplate->renderContent());
    }

    /**
     * salva i parametri inseriti o modificati nella Pagina di configurazione Contatti Copyrights & Credits nella sezione Contatti
     *
     * @return void
     */
    public function salvaContattiAction(): ResponseInterface {

        $constantNames= array(
        	'contacts.address',
			'contacts.dati_fiscali',
            'contacts.email',
            'contacts.pec',
            'contacts.tel',
            'contacts.fax',
			'contacts.numero_verde');

        $this->updateContstants($constantNames);

		return $this->redirect('contatti');
	}

    /**
     * salva i parametri inseriti o modificati nella Pagina di configurazione Contatti nella sezione Copyrights & Credits
     *
     * @return void
     */
    public function salvaCopyrightAndCreditsAction(): ResponseInterface {

        $constantNames= array(
            'copyrights.nextgenerationeu',
            'copyrights.copyright',
            'copyrights.credits');

        $this->updateContstants($constantNames);

		return $this->redirect('contatti');
	}

    /**
     * visualizza la form della pagina di configurazione Cookies
     *
     * @return void
     */
    public function cookiesAction(): ResponseInterface {
		$this->view->assign('action', 'cookies');

		$vettCookiesConf = $this->abstractRepository->findConstantsSysTemplate($this->templateUid);

        $vettCookiesConf = $this->populateForm('cookies', $vettCookiesConf);

        $this->view->assign('vettCookiesConf',$vettCookiesConf);

		$moduleTemplate = $this->moduleTemplateFactory->create($this->request);
		// Adding title, menus, buttons, etc. using $moduleTemplate ...
		$moduleTemplate->setContent($this->view->render());
		return $this->htmlResponse($moduleTemplate->renderContent());
    }

    /**
     *  salva i parametri inseriti o modificati nella Pagina di configurazione Cookies
     *
     * @return void
     */
    public function salvaCookiesAction(): ResponseInterface {

        $constantNames= array(
        	'cookies.profiling',
        	'cookies.webanalytics',
            'cookies.trackingurl',
            'cookies.siteid');

        $this->updateContstants($constantNames);

		return $this->redirect('cookies');
    }

    /**
     *
     * visualizza la form della pagina di configurazione Pagine e contenitori
     *
     *
     * @return void
     */
    public function pageAction(): ResponseInterface {
		$this->view->assign('action', 'page');

		$vettPageConf = $this->abstractRepository->findConstantsSysTemplate($this->templateUid);

        $vettPageConf = $this->populateForm('pages', $vettPageConf);

        $vettPageConf = $this->populateForm('containers', $vettPageConf);

        $this->view->assign('vettPageConf',$vettPageConf);

		$moduleTemplate = $this->moduleTemplateFactory->create($this->request);
		// Adding title, menus, buttons, etc. using $moduleTemplate ...
		$moduleTemplate->setContent($this->view->render());
		return $this->htmlResponse($moduleTemplate->renderContent());
    }

    /**
     *  salva i parametri inseriti o modificati nella Pagina di configurazione Pagine e contenitori, nella sezione Pagine
     *
     * @return void
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     */
    public function salvaPageAction(): ResponseInterface {

        $constantNames= array('pages.id_faq',
			'pages.id_assistenza',
			'pages.id_prenota',
			'pages.id_segnala',
        	'pages.id_archivio_news',
            'pages.id_login',
            'pages.id_registration',
            'pages.id_privacy',
            'pages.id_note_legali',
			'pages.id_trasparenza',
			'pages.id_accessibilita',
            'pages.id_mappa',
            'pages.id_credits',
            'pages.id_search',
            'pages.id_archivio_news');

        foreach ($constantNames as $constantName) {
            if ($this->request->hasArgument($constantName)) {

                if( !is_numeric($this->request->getArgument($constantName)) && $this->request->getArgument($constantName)!==''){
                    //TODO: usare dei flash messages
                    throw new \Exception("Tutti i campi di questa form devono essere numeri interi o vuoti");
                }

            }
        }

        $this->updateContstants($constantNames);

		return $this->redirect('page');
	}

    /**
     *
     *  salva i parametri inseriti o modificati nella Pagina di configurazione Pagine e contenitori, nella sezione contenitori
     *
     * @return void
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     */
    public function salvaContainerAction(): ResponseInterface {

        $constantNames= array(
            'containers.id_folder_news',
            'containers.id_folder_users');

        foreach ($constantNames as $constantName) {
            if ($this->request->hasArgument($constantName)) {

                if( !is_numeric($this->request->getArgument($constantName)) && $this->request->getArgument($constantName)!==''){
                    //TODO: usare dei flash messages
                    throw new \Exception("Tutti i campi di questa form devono essere numeri interi o vuoti");
                }

            }
        }


        $this->updateContstants($constantNames);

		return $this->redirect('page');
	}

	/**
	 * Visualizza le costanti nella form di gestione dei servizi links
	 *
	 * @return void
	 */
	public function serviziAction(): ResponseInterface {
		$this->view->assign('action', 'servizi');

		$vettServiziConf = $this->abstractRepository->findConstantsSysTemplate($this->templateUid);

		$vettServiziConf = $this->populateForm('servizi', $vettServiziConf);

		$this->view->assign('vettServiziConf',$vettServiziConf);

		$moduleTemplate = $this->moduleTemplateFactory->create($this->request);
		// Adding title, menus, buttons, etc. using $moduleTemplate ...
		$moduleTemplate->setContent($this->view->render());
		return $this->htmlResponse($moduleTemplate->renderContent());
	}

	/**
	 * Legge tutte le costanti servizi dal template, sostituisce quelle lette dalla form e aggiorna tutte le costanti
	 *
	 * @return void
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
	 */
	public function salvaServiziInformatoAction(): ResponseInterface {

		/* controllo i parametri inseriti o modificati nella Pagina di configurazione servizi  */
		$constantNames= array('servizi.prenota_appuntamento.url');

		$this->updateContstants($constantNames);

		return $this->redirect('servizi');
	}

	/**
	 * Legge tutte le costanti servizi dal template, sostituisce quelle lette dalla form e aggiorna tutte le costanti
	 *
	 * @return void
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
	 */
	public function salvaServiziAttivoAction(): ResponseInterface {

		/* controllo i parametri inseriti o modificati nella Pagina di configurazione servizi  */
		$constantNames= array('servizi.iscrizione_trasporto_scolastico.id',
			'servizi.iscrizione_trasporto_scolastico.url',
			'servizi.iscrizione_mensa_scolastica.id',
			'servizi.iscrizione_mensa_scolastica.url',
			'servizi.iscrizione_asilo_nido.id',
			'servizi.iscrizione_asilo_nido.url',
			'servizi.pagamento_imu.id',
			'servizi.pagamento_imu.url');

		$this->updateContstants($constantNames);

		return $this->redirect('servizi');
	}

    /**
     * Visualizza le costanti nella form di gestione dei social links
     *
     * @return void
     */
    public function socialAction(): ResponseInterface {
		$this->view->assign('action', 'social');

        $vettSocialConf = $this->abstractRepository->findConstantsSysTemplate($this->templateUid);

        $vettSocialConf = $this->populateForm('social', $vettSocialConf);

        $this->view->assign('vettSocialConf',$vettSocialConf);

		$moduleTemplate = $this->moduleTemplateFactory->create($this->request);
		// Adding title, menus, buttons, etc. using $moduleTemplate ...
		$moduleTemplate->setContent($this->view->render());
		return $this->htmlResponse($moduleTemplate->renderContent());
    }

    /**
     * Legge tutte le costanti social links dal template, sostituisce quelle lette dalla form e aggiorna tutte le costanti
     *
     * @return void
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     */
    public function salvaSocialAction(): ResponseInterface {

		/* controllo i parametri inseriti o modificati nella Pagina di configurazione Social Links */
        $constantNames= array('social.facebook.url',
                            'social.twitter.url',
                            'social.instagram.url',
                            'social.youtube.url',
                            'social.vimeo.url',
                            'social.linkedin.url',
                            'social.telegram.url',
							'social.whatsapp.url',
                            'social.rss.url');

        $this->updateContstants($constantNames);

		return $this->redirect('social');
    }

    /**
     * funzione ricorsiva che prende il page id , fa query su sys_template per pid,
     * se c'è definito un template root lo restituisce al chiamante, altrimenti cerca il pid
     * della pagina corrente e chiama se stessa
     *
     *
     * @param int $
     * @return void
     * @throws DBALException
     */
    protected function setSysTemplateUid(int $pageId): void{

        $this->templateUid = $this->abstractRepository->findCurrentSyTemplate($pageId);

        if($this->templateUid==-1) {
            $parentPageId=$this->abstractRepository->findParentPage($pageId);
            if($parentPageId<0) {
                throw new \Exception("Pagina non trovata per uid=" . $pageId);
            } else {
                $this->setSysTemplateUid($parentPageId);
            }
        }

    }

    /**
     * Memorizza in un array le costanti typoscript lette dal db per passarle a fluid
     *
     * @param array $vett
     * @param string $key
     * @param string $value
     * @return array
     */
    private function convertDottedStringToNestedArrays(array $vett, string $key, string $value) : array {

        unset($vett[$key]);
        $prefixKey=substr($key,0,stripos($key, '.'));
        $subfixKey=substr($key, stripos($key, '.')+1);

        if(stripos($subfixKey,'.')){
            if(!is_array($vett[$prefixKey])){
                $vett[$prefixKey]=$this->convertDottedStringToNestedArrays(array($subfixKey => $value), $subfixKey, $value);
            } else {
                $vett[$prefixKey]=$this->convertDottedStringToNestedArrays($vett[$prefixKey], $subfixKey, $value);
            }

        } else {
            if(!is_array($vett[$prefixKey])){
                $vett[$prefixKey] = array($subfixKey => $value);
            } else {
                $vett[$prefixKey][$subfixKey]=$value;
            }

        }

        return $vett;
    }

    /**
     * legge tutti i valori che sono presenti nel campo constants della tabella sys_template
     *
     * @param String $constantType
     * @return void
     */
    private function populateForm(String $constantType, array $vettSocialConf) : array {

         //estraggo solo le constant del tipo $constantType e le mando a fluid
        foreach($vettSocialConf as $key=>$value){
            if(stripos($key,$constantType)===0) {
                if (stripos($key, '.')>0) {
                    $vettSocialConf = $this->convertDottedStringToNestedArrays($vettSocialConf, $key, $value);
                }
            }
        }

        // TODO: Usare i PLACEHOLDER nella form:
        // se vogliamo mostrare dei placholder con dei default si deve poter accedere alle costanti typoscript presenti
        // nel file bit3/Configuration/Typoscript/contants.txt come fa la form del Constant Editor
        return $vettSocialConf;
    }

	/**
	 * aggiorna tutte le costanti dei colori lette dalla form e calcolate nella funzione
	 *
	 * @param array $constantNames
	 * @return void
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
	 */
	private function updateColorContstants(array $constantNames) : void {
		$vettTSConstants = $this->abstractRepository->findConstantsSysTemplate($this->templateUid);
		$constantValue='';

		foreach ($constantNames as $constantName){
			$constantNameInput = str_replace(".", "_", $constantName);
			if ($this->request->hasArgument($constantNameInput)) {
				$constantValue = trim($this->request->getArgument($constantNameInput));
				if($constantValue==='' || $constantValue==null) {
					unset($vettTSConstants[$constantName]);
				} else {
					// il default di un input type color è #000000, regitro la costante e calcolo la gamma solo se è diverso da #000000
					if ($constantValue == '#000000') {
						unset($vettTSConstants[$constantName]);
					}else{
						$vettTSConstants[$constantName] = $constantValue;

						list($r, $g, $b) = sscanf($constantValue, "#%02x%02x%02x");
						$vettTSConstants['skin.bg_primary_rgb'] = $r.', '.$g.', '.$b;

						$newHex = $this->calculateNewColor($constantValue, -29);
						$vettTSConstants['skin.darken_primary_color'] = $newHex;

						$newHex = $this->calculateNewColor($constantValue, 17);
						$vettTSConstants['skin.lighten_primary_color'] = $newHex;

						$newHex = $this->calculateNewColor($constantValue, 51);
						$vettTSConstants['skin.lightest_primary_color'] = $newHex;
					}
				}
			}
		}

		$contConstants = '';
		foreach($vettTSConstants as $key=>$values){
			$sigleConstants = $key. ' = '.$values.chr(13).chr(10);
			$contConstants .= $sigleConstants;
		}

		$contConstants = substr_replace($contConstants,'',strrpos($contConstants,chr(13).chr(10)));
		$this->abstractRepository->updateCostantsSysTemplate($contConstants, $this->templateUid);


	}

    /**
     * aggiorna tutte le costanti lette dalla form
     *
     * @param array $constantNames
     * @return void
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     */
    private function updateContstants(array $constantNames) : void {
        $vettTSConstants = $this->abstractRepository->findConstantsSysTemplate($this->templateUid);
        $constantValue='';

        foreach ($constantNames as $constantName){
        	$constantNameInput = str_replace(".", "_", $constantName);
            if ($this->request->hasArgument($constantNameInput)) {
                $constantValue = trim($this->request->getArgument($constantNameInput));
                if($constantValue==='' || $constantValue==null) {
                    unset($vettTSConstants[$constantName]);
                } else {
                    $vettTSConstants[$constantName]  = $constantValue;
                }
            }

        }

        $contConstants = '';
        foreach($vettTSConstants as $key=>$values){
            $sigleConstants = $key. ' = '.$values.chr(13).chr(10);
            $contConstants .= $sigleConstants;
        }
        $contConstants = substr_replace($contConstants,'',strrpos($contConstants,chr(13).chr(10)));
        $this->abstractRepository->updateCostantsSysTemplate($contConstants, $this->templateUid);


    }


	/**
	 * calcolo il nuovo valore del colore in HEX e lo normalizzo tra 0 e 255
	 *
	 * @param string $hexColor // colore esadecimale di partenza
	 * @param int $diff // differenza da calcolare, positivo schiarisce, negativo scurisce
	 * @return string
	 */
	private function calculateNewColor(string $hexColor, int $diff) : string {
		$newHexColor ='';

		list($r, $g, $b) = sscanf($hexColor, "#%02x%02x%02x");

		//calcolo il canale red
		$rnew = $r + $diff;
		if ($rnew < 0) { $rnew = 0; }
		if ($rnew > 255) { $rnew = 255; }

		//calcolo il canale green
		$gnew = $g + $diff;
		if ($gnew < 0) { $gnew = 0; }
		if ($gnew > 255) { $gnew = 255; }

		//calcolo il canale blu
		$bnew = $b + $diff;
		if ($bnew < 0) { $bnew = 0; }
		if ($bnew > 255) { $bnew = 255; }

		$newHexColor = sprintf("#%02x%02x%02x", $rnew, $gnew, $bnew);

		return $newHexColor;
	}

}