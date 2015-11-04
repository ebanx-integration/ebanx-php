<?php
/**
 * Copyright (c) 2013, EBANX Tecnologia da Informação Ltda.
 *  All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * Redistributions of source code must retain the above copyright notice, this
 * list of conditions and the following disclaimer.
 *
 * Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *
 * Neither the name of EBANX nor the names of its
 * contributors may be used to endorse or promote products derived from
 * this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

require_once 'Ebanx/Ebanx.php';
require_once 'Ebanx/Config.php';
require_once 'Ebanx/Http/Client.php';
require_once 'Ebanx/Command/AbstractCommand.php';
require_once 'Ebanx/Command/BankList.php';
require_once 'Ebanx/Command/Factory.php';
require_once 'Ebanx/Command/Validator.php';
require_once 'Ebanx/Command/Request/Direct.php';
require_once 'Ebanx/Command/Request/Checkout.php';
require_once 'Ebanx/Command/Cancel.php';
require_once 'Ebanx/Command/Capture.php';
require_once 'Ebanx/Command/Exchange.php';
require_once 'Ebanx/Command/PrintHtml.php';
require_once 'Ebanx/Command/Query.php';
require_once 'Ebanx/Command/Refund.php';
require_once 'Ebanx/Command/RefundOrCancel.php';
require_once 'Ebanx/Command/Token.php';
require_once 'Ebanx/Command/Zipcode.php';
require_once 'Ebanx/Command/DocumentBalance.php';